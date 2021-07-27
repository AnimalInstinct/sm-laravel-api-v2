<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\User;
use App\Notifications\SignupActivate;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        // return response()->json([
        //     'response'=>$request->all()
        // ], 201);
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'activation_token' => str_random(60)
        ]);

        $host = $request->header('Origin');

        $user->save();
        $user->assignRole('Registered');
        $user->notify(new SignupActivate($user, $host));
        $tokenResult = $user->createToken('Personal Access Token');

        return response()->json([
            'message' => 'Successfully created user!',
            'user' => $user,
            'token' => $tokenResult->accessToken
        ], 201);
    }

    public function signupActivate(Request $request)
    {
        $token = $request->token;
        $user = User::where('activation_token', $token)->first();
        $current_date_time = Carbon::now()->toDateTimeString();

        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid or account is active.'
            ], 500);
        } else {
            if ($user->active) {
                return response()->json([
                    'message' => 'User is already active.'
                ], 201);
            } else {
                $user->active = true;
                $user->activation_token = '';
                $user->email_verified_at = now();
                $user->save();
                $user->assignRole('Active');

                return response()->json([
                    'message' => 'Successfully activated!',
                    'user' => $user
                ], 201);
            }
        }
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function signin(Request $request)
    {
        // return response()->json([
        //     'response' => $request->all()
        // ], 200);
        $user = User::where('email', $request->email)->first();

        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);
        // $credentials['active'] = 1;
        // $credentials['deleted_at'] = null;

        if (!Auth::guard('web')->attempt($credentials))
            return response()->json([
                'message' => 'Login or password is incorrect'
            ], 422);
        // $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'message' => 'Successfully logged in',
            'user' => $user,
            'roles' => $user->roles
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}

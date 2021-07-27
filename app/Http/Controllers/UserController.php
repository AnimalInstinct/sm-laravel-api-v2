<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-view', ['only' => ['show']]);
        $this->middleware('permission:user-create', ['only' => ['store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->middleware('permission:user-assign-roles', ['only' => ['addRole', 'removeRole', 'assignRoleToAll']]);
        $this->middleware('permission:user-profile', ['only' => ['profile', 'userLoggedInRoles']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return response()->json([
        //     'response'=>$request->role_id
        // ], 201);
        if ($request->showTrashed === "true") {
            $users = User::onlyTrashed()->get();
        } else {
            $users = User::all();
        }
        if ($request->role_id) {
            $users = User::whereHas("roles", function ($roles) use ($request) {
                $roles->where("id", $request->role_id);
            })->get();
        }
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create();
        $user->update($request->all());
        $user->assignRole('registered');
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return response()->json([
        //     'response'=>'Show'
        // ], 201);
        $user = User::where('id', $id)->withTrashed()->get()->first();

        return new UserResource($user);
    }

    public function profile(Request $request)
    {
        $user = Auth::user();
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $request->id)->withTrashed()->get()->first();
        $user->update($request->all());
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::where('id', $id)->withTrashed()->get()->first();
        if ($request->deleted_at == null) {
            $user->delete();
            return new UserResource($user);
        } else {
            $user->forceDelete();
        }
    }

    public function addRole(Request $request)
    {
        $user = User::withTrashed()->find($request->userId);
        $role = Role::find($request->roleId);
        $user->assignRole($role->name);
        return response()->json([
            'roles' => $user->roles
        ], 200);
    }

    public function removeRole(Request $request)
    {
        $user = User::withTrashed()->find($request->userId);
        $user->removeRole($request->roleId);
        return response()->json([
            'roles' => $user->roles
        ], 200);
    }

    public function userRoles(Request $request)
    {
        $user = User::withTrashed()->find($request->user);
        return response()->json([
            'roles' => $user->roles
        ], 200);
    }

    public function userLoggedInRoles(Request $request)
    {
        $user = Auth::user();
        return response()->json([
            'roles' => $user->roles
        ], 200);
    }

    //Temp script to convert all role assignment to new model
    public function assignRoleToAll()
    {
        // return response()->json([
        //     'response'=>'Hello'
        // ], 200);
        $users = User::all()->withTrashed();
        foreach ($users as $key => $user) {
            if (!$user->hasAllRoles(Role::all())) {
                $role = Role::find($user->role_id);
                $user->assignRole($role->name);
                $user->assignRole('Active');
            };
        }
        return response()->json([
            'response' => 'All roles assigned'
        ], 200);
    }
}

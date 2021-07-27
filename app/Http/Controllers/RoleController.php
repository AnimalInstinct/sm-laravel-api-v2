<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('permission:role-list', ['only' => ['index']]);
        $this->middleware('permission:role-create', ['only' => ['store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //  return response()->json([
        //     'response'=>$request->id
        // ], 201);
        if ($request->showTrashed === "true") {
            $roles = Role::onlyTrashed()->get();
        } else {
            $roles = Role::all();
        }
        return RoleResource::collection($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::create();
        $role->update($request->all());
        return new RoleResource($role);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::where('id', $id)->withTrashed()->get()->first();
        return new RoleResource($role);
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
        $role = Role::where('id', $id)->withTrashed()->get()->first();;
        $role->update($request->all());
        return new RoleResource($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $role = Role::where('id', $id)->withTrashed()->get()->first();
        if ($request->deleted_at == null) {
            $role->delete();
            return new RoleResource($role);
        } else {
            $role->forceDelete();
        }
    }

    public function addPermission(Request $request)
    {
        $role = Role::find($request->roleId);
        $permission = Permission::find($request->permissionId);
        $role->givePermissionTo($permission->name);
        return response()->json([
            'permissions' => $role->permissions
        ], 200);
    }

    public function removePermission(Request $request)
    {
        $role = Role::find($request->roleId);
        $permission = Permission::find($request->permissionId);
        $permission->removeRole($role);
        return response()->json([
            'permissions' => $role->permissions
        ], 200);
    }

    public function rolePermissions(Request $request)
    {
        $role = Role::withTrashed()->find($request->role);
        return response()->json([
            'permissions' => $role->permissions
        ], 200);
    }
}

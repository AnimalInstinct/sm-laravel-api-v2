<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('permission:permission-list', ['only' => ['index']]);
        $this->middleware('permission:permission-create', ['only' => ['store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->showTrashed === "true") {
            $permissions = Permission::onlyTrashed()->get();
        } else {
            $permissions = Permission::all();
        }
        return PermissionResource::collection($permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permission = Permission::create();
        $permission->update($request->all());
        return new PermissionResource($permission);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::where('id', $id)->withTrashed()->get()->first();
        return new PermissionResource($permission);
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
        $permission = Permission::where('id', $id)->withTrashed()->get()->first();;
        $permission->update($request->all());
        return new PermissionResource($permission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $permission = Permission::where('id', $id)->withTrashed()->get()->first();
        if ($request->deleted_at == null) {
            $permission->delete();
            return new PermissionResource($permission);
        } else {
            $permission->forceDelete();
        }
    }
}

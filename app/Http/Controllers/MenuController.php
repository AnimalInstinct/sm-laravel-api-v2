<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Http\Resources\MenuResource;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:menu-create', ['only' => ['store']]);
        $this->middleware('permission:menu-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:menu-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //If all menus requested fwithout any filters.
        if ($request->showTrashed === "true") {
            $menus = Menu::onlyTrashed()->get();
        } else {
            $menus = Menu::all();
        }
        //If requested menu for users signed in with roles specified.
        if ($request->byroles) {
            $menus = [];
            $defaultMenus = Menu::where('component_id', $request->component_id)->where('role_id', NULL)->get();
            foreach ($defaultMenus as $m) {
                array_push($menus, $m);
                $m->items;
            }
            if (Auth::user()) {
                $roles = Auth::user()->roles;
                foreach ($roles as $role) {
                    $mbr = Menu::where('component_id', $request->component_id)->where('role_id', $role->id)->get();
                    foreach ($mbr as $m) {
                        array_push($menus, $m);
                        $m->items;
                    }
                }
            }
            // return response()->json([
            //     'menus'=>$menus
            // ], 201);
            $menus = collect($menus);
        }
        return MenuResource::collection($menus);
    }

    public function store(Request $request)
    {
        $menu = Menu::create();
        $menu->update($request->all());
        return new MenuResource($menu);
    }

    public function show($id)
    {
        $menu = Menu::where('id', $id)->withTrashed()->get()->first();
        return new MenuResource($menu);
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::where('id', $id)->withTrashed()->get()->first();;
        $menu->update($request->all());
        return new MenuResource($menu);
    }

    public function destroy(Request $request, $id)
    {
        $menu = Menu::where('id', $id)->withTrashed()->get()->first();
        if ($request->deleted_at == null) {
            $menu->delete();
            return new MenuResource($menu);
        } else {
            $menu->forceDelete();
        }
    }
}

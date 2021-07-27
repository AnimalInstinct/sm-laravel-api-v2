<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Http\Resources\MenuItemResource;

class MenuItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:menuitem-create', ['only' => ['store']]);
        $this->middleware('permission:menuitem-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:menuitem-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->showTrashed === "true") {
            $menuitems = MenuItem::onlyTrashed()->get();
        } else {
            $menuitems = MenuItem::all();
        }
        return MenuItemResource::collection($menuitems);
    }

    public function store(Request $request)
    {
        $menuitem = MenuItem::create();
        $menuitem->update($request->all());
        return new MenuItemResource($menuitem);
    }

    public function show($id)
    {
        $menuitem = MenuItem::where('id', $id)->withTrashed()->get()->first();
        return new MenuItemResource($menuitem);
    }

    public function update(Request $request, $id)
    {
        $menuitem = MenuItem::where('id', $id)->withTrashed()->get()->first();;
        $menuitem->update($request->all());
        return new MenuItemResource($menuitem);
    }

    public function destroy(Request $request, $id)
    {
        $menuitem = MenuItem::where('id', $id)->withTrashed()->get()->first();
        if ($request->deleted_at == null) {
            $menuitem->delete();
            return new MenuItemResource($menuitem);
        } else {
            $menuitem->forceDelete();
        }
    }
}

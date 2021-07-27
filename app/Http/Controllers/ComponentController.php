<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComponentResource;
use Illuminate\Http\Request;
use App\Models\Component;

class ComponentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        // $this->middleware('permission:component-list', ['only' => ['index']]);
        $this->middleware('permission:component-view', ['only' => ['show']]);
        $this->middleware('permission:component-create', ['only' => ['store']]);
        $this->middleware('permission:component-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:component-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->showTrashed === "true") {
            $components = Component::onlyTrashed()->get();
        } else {
            $components = Component::all();
        }
        return ComponentResource::collection($components);
    }

    public function store(Request $request)
    {
        $component = Component::create();
        $component->update($request->all());
        return new ComponentResource($component);
    }

    public function show($id)
    {
        $component = Component::where('id', $id)->withTrashed()->get()->first();
        return new ComponentResource($component);
    }

    public function update(Request $request, $id)
    {
        $component = Component::where('id', $request->id)->withTrashed()->get()->first();
        $component->update($request->all());
        return new ComponentResource($component);
    }

    public function destroy(Request $request, $id)
    {
        $component = Component::where('id', $id)->withTrashed()->get()->first();
        if ($request->deleted_at == null) {
            $component->delete();
            return new ComponentResource($component);
        } else {
            $component->forceDelete();
        }
    }

    public function images(Request $request)
    {
        $component = Component::find($request->id);
        return response()->json($component->images, 200);
    }
}

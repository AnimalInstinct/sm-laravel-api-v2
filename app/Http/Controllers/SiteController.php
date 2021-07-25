<?php

namespace App\Http\Controllers;

use App\Http\Resources\SiteResource;
use Illuminate\Http\Request;
use App\Site;

class SiteController extends Controller

{
    public function __construct()
    {
        $this->middleware('permission:site-list', ['only'=>['index']]);
        $this->middleware('permission:site-view', ['only'=>['show']]);
        $this->middleware('permission:site-create', ['only' => ['store']]);
        $this->middleware('permission:site-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:site-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->showTrashed === "true") {
            $sites = Site::onlyTrashed()->get();
        } else {
            $sites = Site::all();
        }
        return SiteResource::collection($sites);
    }

    public function store(Request $request)
    {
        $site = Site::create();
        $site->update($request->all());
        return new SiteResource($site);
    }

    public function show(Request $request, $id)
    {
        if ($request->type && $request->type == "alias"){
            $site = Site::where('alias', $id)->get()->first();
            
        } else {
            $site = Site::where('id', $id)->withTrashed()->get()->first();
        }
        if($site){
            return new SiteResource($site);
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $site = Site::where('id', $request->id)->withTrashed()->get()->first();
        $site->update($request->all());
        // return new SiteResource($site);
        return response()->json(['message' => 'Page saved!'], 200);
    }

    public function destroy(Request $request, $id)
    {
        $site = Site::where('id', $id)->withTrashed()->get()->first();
        if ($request->deleted_at == null) {
            $site->delete();
            return new SiteResource($site);
        } else {
            $site->forceDelete();
        }
    }

    public function images(Request $request)
    {
        $site = Site::find($request->id);
        return response()->json($site->images, 200);
    }
}

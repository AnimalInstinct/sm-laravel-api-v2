<?php

namespace App\Http\Controllers;

use App\Http\Resources\PageResource;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:page-list', ['only' => ['index']]);
        $this->middleware('permission:page-create', ['only' => ['store']]);
        $this->middleware('permission:page-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:page-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->showTrashed === "true") {
            $pages = Page::onlyTrashed()->get();
        } else {
            $pages = Page::all();
        }
        return PageResource::collection($pages);
    }

    public function store(Request $request)
    {
        $page = Page::create();
        $page->update($request->all());
        return new PageResource($page);
    }

    public function show(Request $request, $id)
    {
        if ($request->type && $request->type == "alias") {
            $page = Page::where('alias', $id)->get()->first();
        } else {
            $page = Page::where('id', $id)->withTrashed()->get()->first();
        }
        if ($page) {
            return new PageResource($page);
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $page = Page::where('id', $request->id)->withTrashed()->get()->first();
        $page->update($request->all());
        // return new PageResource($page);
        return response()->json(['message' => 'Page saved!'], 200);
    }

    public function destroy(Request $request, $id)
    {
        $page = Page::where('id', $id)->withTrashed()->get()->first();
        if ($request->deleted_at == null) {
            $page->delete();
            return new PageResource($page);
        } else {
            $page->forceDelete();
        }
    }

    public function images(Request $request)
    {
        $page = Page::find($request->id);
        return response()->json($page->images, 200);
    }
}

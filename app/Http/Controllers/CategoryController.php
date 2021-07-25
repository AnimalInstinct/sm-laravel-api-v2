<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
        $this->middleware('permission:category-list', ['only'=>['index']]);
        // $this->middleware('permission:category-view', ['only'=>['show']]);
        $this->middleware('permission:category-create', ['only' => ['store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->showTrashed === "true") {
            $categories = Category::onlyTrashed()->get();
        } else {
            $categories = Category::all();
        }
        return CategoryResource::collection($categories);
    }

    public function store(Request $request)
    {
        $category = Category::create();
        $category->update($request->all());
        return new CategoryResource($category);
    }

    public function show(Request $request, $id)
    {
        if ($request->type && $request->type == "alias"){
            $category = Category::where('alias', $id)->get()->first();
            
        } else {
            $category = Category::where('id', $id)->withTrashed()->get()->first();
        }
        if($category){
            return new CategoryResource($category);
        } else {
            abort(404);
        }
        
    }

    public function update(Request $request, $id)
    {
        $category = Category::where('id', $request->id)->withTrashed()->get()->first();
        $category->update($request->all());
        return new CategoryResource($category);
    }

    public function destroy(Request $request, $id)
    {
        $category = Category::where('id', $id)->withTrashed()->get()->first();
        if ($request->deleted_at == null) {
            $category->delete();
            return new CategoryResource($category);
        } else {
            $category->forceDelete();
        }
    }

    public function images(Request $request)
    {
        $category = Category::find($request->id);
        return response()->json($category->images, 200);
    }
}

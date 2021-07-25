<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;
use App\Http\Resources\LanguageResource;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:language-create', ['only' => ['store']]);
        $this->middleware('permission:language-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:language-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->showTrashed === "true"){
            $languages = Language::onlyTrashed()->get();
        } else {
            $languages = Language::all();
        }
        return LanguageResource::collection($languages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $language = Language::create();
        $language->update($request->all());
        return new LanguageResource($language);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $language = Language::where('id', $id)->withTrashed()->get()->first();
        return new LanguageResource($language) ;
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
        $language = Language::where('id', $id)->withTrashed()->get()->first();;
        $language->update($request->all());
        return new LanguageResource($language);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $language = Language::where('id', $id)->withTrashed()->get()->first();
        if ($request->deleted_at == null){
            $language->delete();
            return new LanguageResource($language);
        } else {
            $language->forceDelete();
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Translation;
use App\Language;
use App\Http\Resources\TranslationResource;

class TranslationController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:translation-list', ['only'=>['index']]);
        $this->middleware('permission:translation-view', ['only'=>['show']]);
        $this->middleware('permission:translation-create', ['only' => ['store']]);
        $this->middleware('permission:translation-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:translation-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        if ($request->showTrashed === "true"){
            $translations = Translation::onlyTrashed()->get();
        } else {
            $translations = Translation::all();
        }
        if ($request->component_id){
            $translations = $translations->where('component_id', $request->component_id);
        }
        if ($request->lang_locale){
            $lang_id = Language::where('locale', $request->lang_locale)->get()->first()->id;

            $translations = $translations->where('language_id', $lang_id);
        }
        return TranslationResource::collection($translations);
    }

    public function store(Request $request)
    {
        $translation = Translation::create();
        $translation->update($request->all());
        return new TranslationResource($translation);
    }

    public function show($id)
    {
        $translation = Translation::where('id', $id)->withTrashed()->get()->first();
        return new TranslationResource($translation) ;
    }

    public function update(Request $request, $id)
    {
        // return response()->json([
        //     'response'=>$request->all()
        // ], 201);
        $translation = Translation::where('id', $request->id)->withTrashed()->get()->first();;
        $translation->update($request->all());
        return new TranslationResource($translation);
    }

    public function destroy(Request $request, $id)
    {
        $translation = Translation::where('id', $id)->withTrashed()->get()->first();
        if ($request->deleted_at == null){
            $translation->delete();
            return new TranslationResource($translation);
        } else {
            $translation->forceDelete();
        }
    }
}

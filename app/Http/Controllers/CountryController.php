<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\CountryResource;
use App\Models\Country;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('permission:country-list', ['only' => ['index']]);
        $this->middleware('permission:country-create', ['only' => ['store']]);
        $this->middleware('permission:country-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:country-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->showTrashed) {
            $countries = Country::onlyTrashed()->get();
        } else {
            $countries = Country::all();
        }
        return CountryResource::collection($countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = Country::create();
        return new CountryResource($country);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $country = Country::where('id', $id)->withTrashed()->get()->first();
        return new CountryResource($country);
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
        $country = Country::where('id', $id)->withTrashed()->get()->first();;
        $country->update($request->all());
        return new CountryResource($country);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $country = Country::where('id', $id)->withTrashed()->get()->first();
        if ($request->deleted_at == null) {
            $country->delete();
            return new CountryResource($country);
        } else {
            $country->forceDelete();
        }
    }
}

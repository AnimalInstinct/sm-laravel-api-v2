<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use App\Http\Resources\ImageResource;
use Illuminate\Support\Facades\Storage;
use Intervention;
use App\Page;
use DB;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('permission:image-list', ['only'=>['index']]);
        $this->middleware('permission:image-view', ['only' => ['show']]);
        $this->middleware('permission:image-create', ['only' => ['store']]);
        $this->middleware('permission:image-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:image-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->showTrashed === "true") {
            $images = Image::onlyTrashed()->get();
        } else {
            $images = Image::all();
        }
        return ImageResource::collection($images);
    }

    public function createThumbnail($path, $width, $height)
    {
        $img = Intervention::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,svg,gif',
        ]);

        if($request->hasFile('file')) {
            //get filename with extension
            $filenamewithextension = $request->file('file')->getClientOriginalName();
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
            //Upload File
            $request->file('file')->storeAs('/public/images', $filenametostore);

            //save image in database
            $image = new Image;
            $image->path = '/storage/images/';
            $image->name = $filenametostore;
            $image->imageable_type = "App\\".$request->model;
            $image->imageable_id = $request->id;
            $image->save();

            if ($extension != 'svg'){
                //small thumbnail name
                $smallthumbnail = 'small_'.$filename.'_'.time().'.'.$extension;
                //medium thumbnail name
                $mediumthumbnail = 'medium_'.$filename.'_'.time().'.'.$extension;
                //large thumbnail name
                $largethumbnail = 'large_'.$filename.'_'.time().'.'.$extension;
                //Upload thumbnails
                $request->file('file')->storeAs('/public/images/thumbnails', $smallthumbnail);
                $request->file('file')->storeAs('public/images/thumbnails', $mediumthumbnail);
                $request->file('file')->storeAs('/public/images/thumbnails', $largethumbnail);
                //create small thumbnail
                $smallthumbnailpath = public_path('/storage/images/thumbnails/'.$smallthumbnail);
                $this->createThumbnail($smallthumbnailpath, 150, 93);
                //create medium thumbnail
                $mediumthumbnailpath = public_path('/storage/images/thumbnails/'.$mediumthumbnail);
                $this->createThumbnail($mediumthumbnailpath, 300, 185);
                //create large thumbnail
                $largethumbnailpath = public_path('/storage/images/thumbnails/'.$largethumbnail);
                $this->createThumbnail($largethumbnailpath, 550, 340);
                //Save thumbnails to image file in database
                $image->thumbnail_sm = $smallthumbnail;
                $image->thumbnail_md = $mediumthumbnail;
                $image->thumbnail_lg = $largethumbnail;
                $image->save();
            }
            

            
        }

        return new ImageResource($image);
    }

    public function show($id)
    {
        $image = Image::where('id', $id)->withTrashed()->get()->first();
        return new ImageResource($image);
    }

    public function update(Request $request, $id)
    {
        $image = Image::where('id', $request->id)->withTrashed()->get()->first();
        $image->update($request->all());
        return new ImageResource($image);
    }

    public function destroy(Request $request, $id)
    {
        $image = Image::where('id', $id)->withTrashed()->get()->first();
        if ($request->deleted_at == null) {
            $image->delete();
            return new ImageResource($image);
        } else {
            $image->forceDelete();
        }
    }
}

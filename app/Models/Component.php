<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Component extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'display_image_id',
        'base_url',
        'schema',
        'model',
        'deleted_at'
    ];

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    public function display_image()
    {
        return $this->belongsTo('App\Image');
    }
}

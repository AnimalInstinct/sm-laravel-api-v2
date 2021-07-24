<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Site extends Model
{
    use SoftDeletes;

    protected $fillable = ['alias', 'domain', 'title', 'description', 'display_image_id'];

    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }

    public function pages()
    {
        return $this->hasMany('App\Page');
    }
}

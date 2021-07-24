<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'parent_id',
        'published',
        'title',
        'description',
        'alias',
        'seotitle',
        'seokeywords',
        'seodescription',
        'author',
        'language_id',
        'intro_image_id',
        'intro_text',
        'site_id',
        'deleted_at'
    ];

    public function images(){
        return $this->morphMany('App\Image', 'imageable');
    }
}

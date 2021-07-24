<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'category_id',
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

    // public function category (){
    //     return $this->belongsTo('App\Category');
    // }

    public function images(){
        return $this->morphMany('App\Image', 'imageable');
    }

    // public function language() {
    //     return $this->belongsTo('App\Language');
    // }

    public function site() {
        return $this->belongsTo('App\Site');
    }

}

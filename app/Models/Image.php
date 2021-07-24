<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'category_id',
        'published',
        'caption',
        'alt',
        'description',
        'geo',
        'name',
        'path',
        'thumbnail_sm',
        'thumbnail_md',
        'thumbnail_lg',
        'imageable_type',
        'imageable_id',
        'deleted_at'
    ];
    
    public function imageable(){
        return $this->morphTo();
    }
}

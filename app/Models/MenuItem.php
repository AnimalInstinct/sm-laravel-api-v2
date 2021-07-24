<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class MenuItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'url','menu_id', 'deleted_at'];

    public function menu()
    {
        return $this->belongsTo();
    }
}

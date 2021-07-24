<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Country extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'deleted_at'];

    public function cities()
    {
        return $this->hasMany('App\City');
    }

    public function places()
    {
        return $this->hasMany('App\Place');
    }
}

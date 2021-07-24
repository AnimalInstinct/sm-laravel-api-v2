<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class City extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function districts()
    {
        return $this->hasMany('App\District');
    }

    public function country()
    {
        return $this->belonsTo('App\Country');
    }

    public function places()
    {
        return $this->hasMany('App\Place');
    }
}

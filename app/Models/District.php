<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class District extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function city()
    {
        return $this->belonsTo('App\City');
    }

    public function places()
    {
        return $this->hasMany('App\Place');
    }
    
}

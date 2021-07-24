<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Place extends Model
{
    use SoftDeletes;

    protected $fillable = ['name','title','description'];

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }
    
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}

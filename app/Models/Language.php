<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'locale', 'deleted_at'];

    public function translations()
    {
        return $this->hasMany('App\Translation');
    }
}

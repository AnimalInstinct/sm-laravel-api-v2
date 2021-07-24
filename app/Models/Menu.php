<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'deleted_at', 'menu_id'];

    public function component()
    {
        return $this->belongsTo('App\Component');
    }

    public function items()
    {
        return $this->hasMany('App\MenuItem');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }
}

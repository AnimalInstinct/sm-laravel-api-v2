<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'deleted_at', 'menu_id'];

    public function component()
    {
        return $this->belongsTo();
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

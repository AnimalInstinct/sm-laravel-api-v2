<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Translation extends Model
{
    use SoftDeletes;

    protected $fillable = ['alias', 'translation', 'language_id', 'component_id', 'deleted_at'];

    public function language()
    {
        return $this->belongsTo('App\Language');
    }
}

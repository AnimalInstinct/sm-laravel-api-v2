<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use SoftDeletes;

    protected $fillable = ['alias', 'translation', 'language_id', 'component_id', 'deleted_at'];

    public function language()
    {
        return $this->belongsTo('App\Language');
    }
}

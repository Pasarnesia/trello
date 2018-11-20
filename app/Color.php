<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'name', 'hex',
    ];

    public function priority()
    {
        return $this->hasMany('App\Priority');
    }
}

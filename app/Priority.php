<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $nullable = [
        'title', 'color',
    ];

    public function color()
    {
        return $this->belongsTo('App\Color');
    }
}

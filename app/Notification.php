<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'content', 'route', 'status', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'cost', 'cost_status', 'address', 'description', 'created_by'
    ];

    public function createdBy(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function listCard()
    {
        return $this->hasMany('App\ListCard');
    }

    public function userProject()
    {
        return $this->hasMany('App\UserProject');
    }

    public function chat()
    {
        return $this->hasMany('App\Chat');
    }
}

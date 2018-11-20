<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListCard extends Model
{
    protected $fillable = [
        'name', 'order', 'project_id',
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    public function activityCard()
    {
        return $this->hasMany('App\ActivityCard');
    }
}

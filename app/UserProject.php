<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    protected $fillable = [
        'project_id', 'user_level_id', 'user_id', 'invited_by_user_id',
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function userLevel()
    {
        return $this->belongsTo('App\UserLevel');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function invitedBy()
    {
        return $this->belongsTo('App\User', 'invited_by_user_id', 'id');
    }
}

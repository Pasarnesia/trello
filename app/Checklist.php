<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = [
        'content', 'status', 'media_id', 'activity_card_id',
    ];

    public function media()
    {
        return $this->belongsTo('App\Media');
    }

    public function activityCard()
    {
        return $this->belongsTo('App\ActivityCard');
    }
}

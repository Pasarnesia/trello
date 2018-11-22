<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityCard extends Model
{
    protected $fillable = [
        'name', 'description', 'due_date', 'order', 'list_card_id', 'transaction_id', 'priority_id', 'media_id'
    ];

    public function listCard()
    {
        return $this->belongsTo('App\ListCard');
    }

    public function priority()
    {
        return $this->belongsTo('App\Priority');
    }
    
    public function checklist()
    {
        return $this->hasMany('App\Checklist');
    }

    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }

    public function media()
    {
        return $this->belongsTo('App\Media');
    }
    
}

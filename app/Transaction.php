<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'name', 'media_id',
    ];

    public function media()
    {
        return $this->belongsTo('App\Media');
    }
    
    public function transactionList()
    {
        return $this->hasMany('App\TransactionList');
    }
}

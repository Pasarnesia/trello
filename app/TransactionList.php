<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionList extends Model
{
    protected $fillable = [
        'name', 'quantity', 'price', 'transaction_id',
    ];

    public function transaction()
    {
        return $this->belongsTo('App\Transakction');
    }
}

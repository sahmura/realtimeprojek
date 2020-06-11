<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transactions';
    protected $connection = 'mysql';
    protected $fillable = [
        'user_id',
        'product_id',
        'courir_id',
        'address_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo('App\Products', 'product_id', 'id');
    }

    public function courir()
    {
        return $this->belongsTo('App\Courirs', 'courir_id', 'id');
    }

    public function address()
    {
        return $this->belongsTo('App\Addresses', 'address_id', 'id');
    }
}

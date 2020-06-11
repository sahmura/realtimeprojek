<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    protected $table = 'addresses';
    protected $connection = 'mysql';
    protected $fillable = [
        'user_id',
        'longitude',
        'latitude',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}

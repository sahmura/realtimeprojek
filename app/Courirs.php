<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courirs extends Model
{
    protected $table = 'courirs';
    protected $connection = 'mysql';
    protected $fillable = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}

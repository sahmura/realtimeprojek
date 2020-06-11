<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $connection = 'mysql';
    protected $fillable = [
        'nama'
    ];
}

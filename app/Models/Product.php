<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'model',
        'company',
        'price',
    ];
    // protected $table = 'products';
}

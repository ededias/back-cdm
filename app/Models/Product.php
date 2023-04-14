<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'discount',
        'discount_type',
        'description',
        'small_description',
        'valid_date',
        'quantity'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = [
        'slug',
        'name',
        'packaging',
        'published',
        'thumbnail',
        'unit_price',
        'bulk_price',
        'unit_size',
        'size_format',
        'tax_percentage',
        'previous_unit_price',
        'category_id',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'brand_id', 'slug_name', 'name_en', 'name_vi', 'image_file_name', 'item_price', 'description',
        'created_by', 'updated_by', 'created_at', 'updated_at'
    ];
}

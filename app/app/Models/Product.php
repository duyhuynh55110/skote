<?php

namespace App\Models;

use App\Models\Traits\AdminTimestamp;
use App\Models\Traits\DisplayNameByLocale;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, AdminTimestamp, DisplayNameByLocale;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_id', 'slug_name', 'name_en', 'name_vi', 'image_file_name', 'item_price', 'description',
        'created_by', 'updated_by', 'created_at', 'updated_at'
    ];

    /**
     * Get full path for products.image_file_name
     *
     * @return Attribute
     */
    public function fullPathImage(): Attribute
    {
        return Attribute::make(
            get: fn() => getFullPathToImage($this, 'image_file_name')
        );
    }

    // ---- Relations
    /**
     * Product belong to many categories
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id')
            ->withTimestamps()
            ->withPivot(['deleted_at'])
            ->using(CategoryProduct::class);
    }

    /**
     * Product belong to a brand
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}

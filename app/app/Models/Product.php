<?php

namespace App\Models;

use App\Models\Traits\AdminTimestamp;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, AdminTimestamp;

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'brand_id', 'slug_name', 'name_en', 'name_vi', 'image_file_name', 'item_price', 'description',
        'created_by', 'updated_by', 'created_at', 'updated_at'
    ];

    /**
     * Get & set products.slug_name
     *
     * @return Attribute
     */
    public function slugName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->slug_name,
            set: function (string $val) {
                return slugifyModel($val, $this);
            }
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
}

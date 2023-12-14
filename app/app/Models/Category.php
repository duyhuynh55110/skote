<?php

namespace App\Models;

use App\Models\Traits\AdminTimestamp;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory, SoftDeletes, AdminTimestamp;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug_name', 'name_en', 'name_vi', 'image_file_name',
        'created_by', 'updated_by', 'created_at', 'updated_at'
    ];

    /**
     * Get & set categories.slug_name
     *
     * @return Attribute
     */
    public function slugName(): Attribute
    {
        return Attribute::make(
            set: function (string $val) {
                return slugifyModel($val, $this);
            }
        );
    }

    /**
     * Get full path for categories.image_file_name
     *
     * @return Attribute
     */
    public function fullPathImage(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image_file_name ? Storage::url($this->image_file_name) : null
        );
    }

    /**
     * Get valid name by header locale
     *
     * @return Attribute
     */
    public function name(): Attribute
    {
        return Attribute::make(
            get: function () {
                return displayNameByLocale($this);
            }
        );
    }
}

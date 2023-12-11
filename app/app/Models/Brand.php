<?php

namespace App\Models;

use App\Models\Traits\AdminTimestamp;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes, AdminTimestamp;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug_name', 'name_en', 'name_vi', 'logo_file_name',
        'created_by', 'updated_by', 'created_at', 'updated_at'
    ];

    /**
     * Get & set brands.slug_name
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
}

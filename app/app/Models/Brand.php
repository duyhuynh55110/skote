<?php

namespace App\Models;

use App\Models\Traits\AdminTimestamp;
use App\Models\Traits\DisplayNameByLocale;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes, AdminTimestamp, DisplayNameByLocale;

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
     * Get full path for brands.logo_file_name
     *
     * @return Attribute
     */
    public function fullPathLogo(): Attribute
    {
        return Attribute::make(
            get: fn() => getFullPathToImage($this, 'logo_file_name')
        );
    }
}

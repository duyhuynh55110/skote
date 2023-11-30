<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['name_en', 'name_vi', 'logo_file_name', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}

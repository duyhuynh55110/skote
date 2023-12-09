<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EndUser extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = [
        'uid', 'phone_number',
        'created_by', 'updated_by', 'created_at', 'updated_at'
    ];
}

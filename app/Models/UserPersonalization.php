<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPersonalization extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'categories', 'sources'];

    // Cast JSON fields to arrays for easy manipulation
    protected $casts = [
        'categories' => 'array',
        'sources' => 'array',
    ];
}

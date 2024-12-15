<?php

namespace App\Models;

use App\Enums\Roles;
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model};

class Role extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebsiteZone extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
    ];

    public function websites(): HasMany
    {
        return $this->hasMany(Website::class);
    }
}

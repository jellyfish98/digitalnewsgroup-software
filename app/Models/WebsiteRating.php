<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteRating extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'ahrefs_updated' => 'datetime',
        'website_id' => 'integer',
    ];

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }
}

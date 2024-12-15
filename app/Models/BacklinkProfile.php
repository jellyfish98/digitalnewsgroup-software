<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BacklinkProfile extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'first_seen' => 'datetime',
        'last_seen' => 'datetime',
    ];

    public function projectDomain(): HasOne
    {
        return $this->hasOne(ProjectDomain::class);
    }
}

<?php

namespace App\Models;

use App\Enums\AssignmentStatuses;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'company_id' => 'integer',
        'project_id' => 'integer',
        'website_id' => 'integer',
        'project_domain_id' => 'integer',
        'order_id' => 'integer',
        'anchor_pairs' => 'array',
//        'status' => AssignmentStatuses::class,
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    public function projectDomain(): BelongsTo
    {
        return $this->belongsTo(ProjectDomain::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}

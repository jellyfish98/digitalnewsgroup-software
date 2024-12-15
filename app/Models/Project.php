<?php

namespace App\Models;

use Filament\Forms\Components\{TextInput, Select};
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\BelongsTo, Relations\HasMany};

class Project extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'company_id' => 'integer',
    ];

    public function projectDomains(): HasMany
    {
        return $this->hasMany(ProjectDomain::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public static function getForm(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            Select::make('company_id')
                ->relationship('company', 'name')
                ->required(),
        ];
    }
}

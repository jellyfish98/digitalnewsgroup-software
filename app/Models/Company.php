<?php

namespace App\Models;

use Filament\Forms\Components\{TextInput, Toggle};
use Illuminate\Database\Eloquent\{Factories\HasFactory, Model, Relations\HasMany};

class Company extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'exclude_stripe_wallet' => 'boolean',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public static function getForm(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('backlinks_retrieved')
                ->required()
                ->numeric()
                ->default(0),
            TextInput::make('backlink_retrieval_limit')
                ->required()
                ->numeric()
                ->default(10000),
            TextInput::make('address')
                ->maxLength(255),
            TextInput::make('city')
                ->maxLength(255),
            TextInput::make('country')
                ->maxLength(255),
            TextInput::make('postal_code')
                ->maxLength(255),
            Toggle::make('exclude_stripe_wallet')
                ->required(),
        ];
    }
}

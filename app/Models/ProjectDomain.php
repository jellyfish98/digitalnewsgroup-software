<?php

namespace App\Models;

use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Components\{Select, TextInput};
use Illuminate\Database\Eloquent\{Builder, Factories\HasFactory, Model, Relations\BelongsTo, Relations\HasMany};

class ProjectDomain extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'company_id' => 'integer',
        'project_id' => 'integer',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function backlinkProfiles(): HasMany
    {
        return $this->hasMany(BacklinkProfile::class);
    }

    public static function getForm(): array
    {
        return [
            TextInput::make('domain_name')
                ->required()
                ->maxLength(255),
            TextInput::make('domain_alias')
                ->maxLength(255),
            Select::make('company_id')
                ->prefixIcon('heroicon-o-building-office-2')
                ->live()
                ->relationship('company', 'name')
                ->required()
                ->afterStateUpdated(function (Set $set) {
                    $set('project_id', '');
                }),
            Select::make('project_id')
                ->prefixIcon('heroicon-o-globe-alt')
                ->helperText('Select a company first to see available projects for that company.')
                ->createOptionForm(Project::getForm())
                ->relationship('project', 'name')
                ->relationship('project', 'name', modifyQueryUsing: function (Builder $query, Get $get) {
                    return $query->where('company_id', $get('company_id'));
                })->required(),
        ];
    }
}

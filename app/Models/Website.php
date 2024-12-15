<?php

namespace App\Models;

use Illuminate\Support\Str;
use Filament\Forms\Components\{Select, TextInput};
use Illuminate\Database\Eloquent\{Factories\HasFactory,
    Model,
    Relations\BelongsTo,
    Relations\BelongsToMany,
    Relations\HasOne
};
use Filament\Forms;

class Website extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'cost_price' => 'decimal:2',
        'retail_price' => 'decimal:2',
        'margin' => 'float',
        'follow' => 'boolean',
        'sponsored_tag' => 'boolean',
        'website_zone_id' => 'integer',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function websiteRating(): HasOne
    {
        return $this->hasOne(WebsiteRating::class);
    }

    public function websiteZone(): BelongsTo
    {
        return $this->belongsTo(WebsiteZone::class);
    }

    public static function getForm()
    {
        return [
            TextInput::make('domain_name')
                ->required()
                ->maxLength(255),
            TextInput::make('cost_price')
                ->required()
                ->numeric(),
            TextInput::make('retail_price')
                ->required()
                ->numeric(),
            TextInput::make('supplier_email')
                ->email()
                ->required()
                ->maxLength(255),
            TextInput::make('pictures')
                ->maxLength(255),
            TextInput::make('ip_address')
                ->maxLength(255),
            Forms\Components\Section::make('Toggles')
                ->columns(2)
                ->schema([
                    Forms\Components\Toggle::make('follow')
                        ->required(),
                    Forms\Components\Toggle::make('sponsored_tag')
                        ->required(),
                ]),
            Forms\Components\Section::make('Selectable options')
                ->columns(2)
                ->schema([
                    Select::make('backlinks')
                        ->options([
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                        ])->required()
                        ->default('1'),
                    TextInput::make('blog_duration')
                        ->required()
                        ->maxLength(255)
                        ->default('permanent'),
                    Select::make('write_content')
                        ->required()
                        ->options([
                            'supplier' => 'Supplier',
                            'dng' => 'DNG',
                        ]),
                    Select::make('website_type')
                        ->options([
                            'blog' => 'Blog',
                            'backlink' => 'Backlink',
                            'blog & backlink' => 'Blog & Backlink',
                        ])
                        ->required()
                        ->default('blog'),
                    Select::make('website_zone_id')
                        ->relationship('websiteZone', 'name')
                        ->required(),
                    TextInput::make('main_country')
                        ->maxLength(255),
                ]),
            TextInput::make('minimal_words')
                ->required()
                ->numeric()
                ->default(500),
            TextInput::make('dng_requirements')
                ->maxLength(255),
            TextInput::make('content_requirements')
                ->maxLength(255),
            TextInput::make('supplier_requirements')
                ->maxLength(255),

        ];
    }
}

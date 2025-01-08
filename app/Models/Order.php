<?php

namespace App\Models;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function saveNewOrder($data): void
    {
        $order = Order::create([
            'uuid' => Str::uuid(),
            'briefing' => 'Briefing for new order',
            'payment_status' => 'pending',
            'payment_method' => 'iDeal',
            'user_id' => Auth::user()->id,
        ]);

        // Hard coded company, project and project domain.
        $company = Company::first();
        $project = $company->projects()->first();
        $projectDomain = $project->projectDomains()->first();

        foreach ($data['anchor'] as $key => $anchors) {
            $validAnchorPairs = [];

            foreach ($anchors as $anchor) {
                // Check if both 'text' and 'url' are filled
                if (!empty($anchor['text']) && !empty($anchor['url'])) {
                    $validAnchorPairs[] = $anchor;
                }
            }

            // Only create an assignment if there are valid anchor pairs
            Assignment::create([
                'website_id' => $key,
                'anchor_pairs' => json_encode($validAnchorPairs),
                'company_id' => $company->id,
                'project_id' => $project->id,
                'project_domain_id' => $projectDomain->id,
                'order_id' => $order->id,
                'writer_name' => $data['write_content'][$key],
                'writer_id' => $data['write_content'][$key] === 'user' ? Auth::user()->id : null,
            ]);
        }
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(Assignment::class);
    }

    public function orderComments(): HasMany
    {
        return $this->hasMany(OrderComment::class);
    }

    public static function getForm(): array
    {
        return [
            TextInput::make('uuid')
                ->label('UUID')
                ->required()
                ->maxLength(255),
            TextArea::make('briefing')
                ->columnSpanFull(),
            TextInput::make('payment_status')
                ->required()
                ->maxLength(255),
            TextInput::make('payment_method')
                ->required()
                ->maxLength(255),
            TextInput::make('user_id')
                ->required()
                ->numeric(),
        ];
    }
}

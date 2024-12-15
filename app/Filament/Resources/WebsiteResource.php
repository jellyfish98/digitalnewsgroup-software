<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WebsiteResource\Pages;
use App\Filament\Resources\WebsiteResource\RelationManagers;
use App\Filament\Tables\Actions\OrderBulkAction;
use App\Models\Website;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use App\Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class WebsiteResource extends Resource
{
    protected static ?string $model = Website::class;
    protected static ?string $navigationGroup = 'Shopping';
    protected static ?string $pluralLabel = 'Marketplace';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form->schema(Website::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading('Available Websites')
            ->description('Find high-quality blogs for guest posting and content promotion. We use data from Moz, Ahrefs, Majestic, and Semrush to help you find the best opportunities.')
            ->striped()
            ->filtersTriggerAction(function ($action) {
                return $action->button()->label('Filters');
            })
            ->columns([
//                WebsiteAddonsColumn::make('addons')
//                    ->label('Addons'),
                Tables\Columns\TextColumn::make('domain_name')
//                    ->view('components.domain-addons')
                    ->description(function (Website $website): string {
                        return "Zone: {$website->websiteZone->name} | Country: {$website->main_country} | Backlinks: {$website->backlinks} | Ip address: {$website->ip_address}";
                    })->extraAttributes(['class' => 'font-semibold'])
                    ->searchable(),
                Tables\Columns\TextColumn::make('cost_price')
                    ->money('EUR')
                    ->prefix('€')
                    ->numeric(decimalPlaces: 2, decimalSeparator: ',', thousandsSeparator: '.')
                    ->sortable(),
                Tables\Columns\TextColumn::make('retail_price')
                    ->money('EUR')
                    ->prefix('€')
                    ->numeric(decimalPlaces: 2, decimalSeparator: ',', thousandsSeparator: '.')
                    ->sortable(),
                Tables\Columns\TextColumn::make('margin')
                    ->numeric(decimalPlaces: 2)
                    ->suffix('%')
                    ->color(fn(float $state): string => match (true) {
                        $state < 20 => 'danger',    // Red for margins below 20%
                        $state < 50 => 'warning',  // Yellow for margins between 20% and 50%
                        $state < 80 => 'success',  // Green for margins between 50% and 80%
                        default => 'primary',      // Blue for margins above 80%
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('supplier_email')
                    ->searchable()
                    ->searchable(isIndividual: true, isGlobal: false),
                Tables\Columns\IconColumn::make('follow')
                    ->boolean(),
                Tables\Columns\IconColumn::make('sponsored_tag')
                    ->boolean(),
                Tables\Columns\TextColumn::make('blog_duration')
                    ->formatStateUsing(fn($state) => ucwords($state))
                    ->searchable(),
                Tables\Columns\TextColumn::make('write_content')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'supplier' => 'Supplier',
                            'dng' => 'DNG',
                        };
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('minimal_words')
                    ->numeric(0, '', '.')
                    ->sortable(),
                Tables\Columns\TextColumn::make('website_type')
                    ->formatStateUsing(fn($state) => ucwords($state))
                    ->searchable(),
//                Tables\Columns\TextColumn::make('pictures')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('delete_reason')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('dng_requirements')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('content_requirements')
//                    ->searchable(),
//                Tables\Columns\TextColumn::make('supplier_requirements')
//                    ->searchable(),
            ])
            ->filters([
                //Custom Retail Price Filter
                Tables\Filters\Filter::make('retail_price')
                    ->form([
                        TextInput::make('retail_price_min')
                            ->numeric()
                            ->label('Min. Price')
                            ->step(1),
                        TextInput::make('retail_price_max')
                            ->numeric()
                            ->label('Max. Price')
                            ->step(1),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['retail_price_min'],
                                fn(Builder $query, $value): Builder => $query->where('retail_price', '>=', $value),
                            )
                            ->when(
                                $data['retail_price_max'],
                                fn(Builder $query, $value): Builder => $query->where('retail_price', '<=', $value),
                            );
                    }),
                Tables\Filters\SelectFilter::make('blog_duration')
                    ->columnSpan(1)
                    ->options([
                        'permanent' => 'Permanent',
                        '1 year' => '1 Year',
                        '2 years' => '2 Years',
                    ])->default('permanent')
                    ->label('Duration'),
                Tables\Filters\TernaryFilter::make('follow')
                    ->columnSpan(1)
                    ->default(true)
                    ->label('Follow'),
                Tables\Filters\TernaryFilter::make('sponsored_tag')
                    ->label('Sponsored Tag'),
            ])->filtersFormWidth(MaxWidth::FourExtraLarge)->filtersFormColumns(4)->filtersLayout(FiltersLayout::Modal)
            ->filtersFormSchema(fn(array $filters): array => [
                Forms\Components\Section::make('Min. & Max. Filters')
                    ->description('Filter by minimum and maximum values and get results between them.')
                    ->schema([
                        $filters['retail_price'],
                    ])
                    ->columns(3),
                $filters['blog_duration'],
                $filters['follow'],
                $filters['sponsored_tag'],
            ])
            ->actions([
                EditAction::make()
                    ->visible(function () {
                        return Auth::user()->role->name === 'admin';
                    })->slideOver(),
            ])
            ->emptyStateHeading('No websites available...')
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('order-selected')
                        ->icon('heroicon-o-shopping-cart')
                        ->color('success')
                        ->deselectRecordsAfterCompletion()
                        ->slideOver()
                        ->form(function (Collection $records) {
                            $fields = [];

                            foreach ($records as $record) {
                                $writeContentOptions = [];
                                $defaultWriteContent = null;
                                $disabled = false;

                                if ($record->write_content === 'supplier') {
                                    $writeContentOptions = ['supplier' => 'Supplier'];
                                    $defaultWriteContent = 'supplier';
                                    $disabled = true;
                                } elseif ($record->write_content === 'dng') {
                                    $writeContentOptions = [
                                        'dng' => 'DNG',
                                        'user' => 'User',
                                    ];
                                    $defaultWriteContent = 'dng';
                                }

                                $fields[] = Forms\Components\Section::make('Details for ' . ($record->domain_name ?? 'Record ' . $record->id))
                                    ->collapsible()
                                    ->schema([
                                        Forms\Components\Select::make('write_content.' . $record->id)
                                            ->label('Who will write the content?')
                                            ->options($writeContentOptions)
                                            ->default($defaultWriteContent)
                                            ->disabled($disabled)
                                            ->required(!$disabled)
                                            ->reactive(),

                                        Forms\Components\Fieldset::make('Backlinks')
                                            ->columns(2)
                                            ->schema(function ($get) use ($record) {
                                                $writeContent = $get('write_content.' . $record->id);
                                                $backlinkFields = [];

                                                for ($i = 0; $i < $record->backlinks; $i++) {
                                                    $backlinkFields[] = Forms\Components\Fieldset::make('Backlink ' . ($i + 1))
                                                        ->columns(2)
                                                        ->columnSpan(1)
                                                        ->schema([
                                                            Forms\Components\Group::make()
                                                                ->columnSpanFull()
                                                                ->schema([
                                                                    TextInput::make('anchor.' . $record->id . '.' . $i . '.text')
                                                                        ->label('Anchor Text')
                                                                        ->disabled($writeContent === 'user')
                                                                        ->helperText(fn() => $i === 0 ? 'Only the first anchor text is required.' : null)
                                                                        ->required($i === 0),
                                                                    TextInput::make('anchor.' . $record->id . '.' . $i . '.url')
                                                                        ->label('Anchor URL')
                                                                        ->required($i === 0)
                                                                        ->disabled($writeContent === 'user')
                                                                        ->helperText(fn() => $i === 0 ? 'Only the first anchor URL is required.' : null)
                                                                        ->url(),
                                                                ]),
                                                        ]);
                                                }
                                                return $backlinkFields;
                                            }),
                                    ]);
                            }
                            return $fields;
                        })
                        ->action(function (Collection $records, array $data) {
                            // Filled with the data from the form.
                            dd($data);
                        }),
                    BulkAction::make('export')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('info')
                        ->deselectRecordsAfterCompletion()
                        ->action(function (Collection $records) {
                            // Export the selected talks
                            Notification::make()->success()
                                ->duration(5000)
                                ->title('Exporting...')
                                ->body('The selected (' . $records->count() . ') websites are being exported.')
                                ->send();
                        }),
                    DeleteBulkAction::make()
                        ->requiresConfirmation()
                        ->color('danger')
                        ->action(function (Collection $records) {
                            $records->each->delete();
                        })->after(function () {
                            Notification::make()->danger()
                                ->duration(5000)
                                ->title('Websites deleted!')
                                ->body('The selected websites have been deleted.')
                                ->send();
                        }),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWebsites::route('/'),
            'create' => Pages\CreateWebsite::route('/create'),
//            'edit' => Pages\EditWebsite::route('/{record}/edit'),
        ];
    }
}

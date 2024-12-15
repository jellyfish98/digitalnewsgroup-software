<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\Test;
use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Models\Company;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;
    protected static ?string $cluster = Test::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form->schema(Company::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('city'),
                Tables\Columns\TextColumn::make('country'),
                Tables\Columns\TextColumn::make('postal_code'),
                Tables\Columns\ToggleColumn::make('exclude_stripe_wallet'),
                Tables\Columns\TextColumn::make('backlinks_retrieved')
                    ->label('Backlinks Retrieved this Month')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('backlink_retrieval_limit')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('exclude_stripe_wallet')
                    ->options([
                        true => 'Exclude Stripe Wallet',
                        false => 'Use Stripe Wallet',
                    ]),
            ])
            ->actions([
                \App\Filament\Tables\Actions\EditAction::make()
                ->slideOver()
            ])
            ->bulkActions([
                \App\Filament\Tables\Actions\BulkActionGroup::make([
                    \App\Filament\Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
//            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}

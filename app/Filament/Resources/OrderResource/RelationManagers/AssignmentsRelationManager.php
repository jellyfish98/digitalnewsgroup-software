<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AssignmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'assignments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('writer_name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('website.domain_name'),
                Tables\Columns\TextColumn::make('anchor_pairs'),
                Tables\Columns\TextColumn::make('website.retail_price')
                    ->money('EUR')
                    ->prefix('€')
                    ->numeric(decimalPlaces: 2, decimalSeparator: ',', thousandsSeparator: '.'),
                Tables\Columns\TextColumn::make('status')->getStateUsing(function ($record) {
                    return ucwords($record->status);
                })->badge()->color(fn($record) => match ($record->status) {
                    'new' => 'success',
                    default => 'primary',
                }),
                Tables\Columns\TextColumn::make('company.name'),
                Tables\Columns\TextColumn::make('project.name'),
                Tables\Columns\TextColumn::make('projectDomain.domain_name'),
                Tables\Columns\TextColumn::make('writer_name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

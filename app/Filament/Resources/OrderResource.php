<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\{Pages, RelationManagers};
use Filament\Infolists\Components\{Section, TextEntry};
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema(Order::getForm());
    }

    public static function getNavigationBadge(): ?string
    {
        return Order::count();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->description(function ($record) {
                        return $record->briefing;
                    })
                    ->label('UUID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('assignment_count')
                    ->getStateUsing(function ($record) {
                        return $record->assignments()->count() . ' Assignments';
                    }),
                Tables\Columns\TextColumn::make('payment_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Order Information')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('uuid'),
                        TextEntry::make('briefing'),
                        TextEntry::make('payment_status'),
                        TextEntry::make('payment_method'),
                        TextEntry::make('user.name')
                            ->getStateUsing(function ($record) {
                                return $record->user->name;
                            }),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AssignmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
//            'edit' => Pages\EditOrder::route('/{record}/edit'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}

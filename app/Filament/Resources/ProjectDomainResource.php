<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\CompaniesAndProjects;
use App\Filament\Resources\ProjectDomainResource\Pages;
use App\Filament\Resources\ProjectDomainResource\RelationManagers;
use App\Models\ProjectDomain;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectDomainResource extends Resource
{
    protected static ?string $model = ProjectDomain::class;
    protected static ?string $cluster = CompaniesAndProjects::class;
    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema(ProjectDomain::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('domain_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('domain_alias')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('project.name')
                    ->numeric()
                    ->sortable(),
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
                Tables\Filters\SelectFilter::make('company_id')
                    ->relationship('company', 'name')
                    ->label(__('Company')),
                Tables\Filters\SelectFilter::make('project_id')
                    ->relationship('project', 'name')
                    ->label(__('Project')),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->slideOver(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProjectDomains::route('/'),
            'create' => Pages\CreateProjectDomain::route('/create'),
//            'edit' => Pages\EditProjectDomain::route('/{record}/edit'),
        ];
    }
}

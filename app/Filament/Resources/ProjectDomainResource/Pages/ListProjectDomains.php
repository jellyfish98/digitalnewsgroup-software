<?php

namespace App\Filament\Resources\ProjectDomainResource\Pages;

use App\Filament\Resources\ProjectDomainResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectDomains extends ListRecords
{
    protected static string $resource = ProjectDomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

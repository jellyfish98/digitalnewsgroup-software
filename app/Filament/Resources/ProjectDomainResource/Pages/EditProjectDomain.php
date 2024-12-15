<?php

namespace App\Filament\Resources\ProjectDomainResource\Pages;

use App\Filament\Resources\ProjectDomainResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectDomain extends EditRecord
{
    protected static string $resource = ProjectDomainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

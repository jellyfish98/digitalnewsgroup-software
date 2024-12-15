<?php

namespace App\Filament\Resources\WebsiteResource\Pages;

use App\Filament\Resources\WebsiteResource;
use App\Models\WebsiteZone;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListWebsites extends ListRecords
{
    protected static string $resource = WebsiteResource::class;

    public function getTabs(): array
    {
        $zones = WebsiteZone::all();

        $tabs = [
            'all' => Tab::make('All Zones'),
        ];

        foreach ($zones as $zone) {
            $tabs[$zone->name] = Tab::make($zone->name)
                ->modifyQueryUsing(function ($query) use ($zone) {
                    $query->where('website_zone_id', $zone->id);
                });
        }

        return $tabs;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

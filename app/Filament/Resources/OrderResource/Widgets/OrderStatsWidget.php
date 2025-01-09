<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use App\Models\Website;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStatsWidget extends BaseWidget
{
    public ?Order $record = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Order Revenue', '€' . $this->calculateTotalOrderCost())
                ->description('Total revenue of all websites in this order.')
                ->color('primary')
                ->icon('heroicon-o-currency-euro'),
        ];
    }

    public function calculateTotalOrderCost(): string
    {
        $websiteIds = $this->record->assignments()->pluck('website_id');
        $totalOrderCost = Website::whereIn('id', $websiteIds)->sum('retail_price');
        return number_format($totalOrderCost, 2, ',', '.');
    }
}

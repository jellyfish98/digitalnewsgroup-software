<?php

namespace App\Filament\Widgets;

use App\Models\Assignment;
use App\Models\Order;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Str;

class GlobalDashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total orders', Order::count() . ' ' . Str::plural('Order', Order::count())),
            Stat::make('Total unique assignments', Assignment::count() . ' ' . Str::plural('Assignment', Assignment::count())),
            Stat::make('Total users', User::count() . ' ' . Str::plural('User', User::count())),
        ];
    }
}

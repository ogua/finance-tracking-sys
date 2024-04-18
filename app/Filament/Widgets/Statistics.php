<?php

namespace App\Filament\Widgets;

use App\Models\Assets;
use App\Models\Employees;
use App\Models\Vendors;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Statistics extends BaseWidget
{
    
    protected static ?int $sort = 1;
    
    protected function getStats(): array
    {
        $employes = Employees::count();
        $assets = Assets::count();
        $vendors = Vendors::count();
        
        return [
            Stat::make('Total Employees', $employes)
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('Total Assets',$assets)
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->color('danger'),
            Stat::make('Total Vendors',$vendors)
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
        ];
    }
}

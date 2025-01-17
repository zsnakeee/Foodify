<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget as BaseWidget;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Stat;
use Number;

class AdvancedStatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Orders', Order::count())
                ->icon('heroicon-o-shopping-cart')
                ->iconPosition('start'),
            Stat::make('Processing Orders', Order::where('status', 'processing')->count())
                ->icon('heroicon-o-clock')
                ->iconPosition('start')
                ->iconColor('info'),
            Stat::make('Completed Orders', Order::where('status', 'completed')->count())
                ->icon('heroicon-o-check-circle')
                ->iconPosition('start')
                ->iconColor('success'),
            Stat::make('Total Sales', Number::currency(Order::sum('total')))
                ->icon('heroicon-o-currency-dollar')
                ->iconPosition('start')
                ->iconColor('success'),
        ];
    }
}

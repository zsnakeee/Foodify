<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrdersOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Orders', Order::count())
                ->icon('heroicon-o-shopping-cart')
                ->description('Total number of orders')
                ->descriptionColor('info'),

            Stat::make('Total Sales', Order::sum('total'))
                ->icon('heroicon-o-currency-dollar')
                ->description('Total sales amount')
                ->descriptionColor('success'),

            Stat::make('Pending Orders', Order::where('status', 'pending')->count())
                ->icon('heroicon-o-clock')
                ->description('Total number of pending orders')
                ->descriptionColor('warning'),
        ];
    }
}

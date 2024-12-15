<?php

namespace App\Filament\Resources\CashierResource\Widgets;

use App\Models\Cashier;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CashierStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Cashiers', Cashier::query()->count())
        ];
    }
}

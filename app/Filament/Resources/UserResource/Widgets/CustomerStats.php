<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\Customer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CustomerStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Customers', Customer::query()->count())
        ];
    }
}

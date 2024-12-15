<?php

namespace App\Filament\Resources\UnitResource\Widgets;

use App\Models\Unit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UnitStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Satuan Obat', Unit::query()->count())
        ];
    }
}

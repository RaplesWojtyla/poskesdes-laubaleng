<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Product;
use App\Models\ProductDetail;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Obat', Product::query()->count()),
            Stat::make('Total Stock Obat', ProductDetail::getTotalStock())
        ];
    }
}

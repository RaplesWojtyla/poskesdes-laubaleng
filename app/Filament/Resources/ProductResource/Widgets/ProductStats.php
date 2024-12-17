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
            Stat::make('Jumlah Obat', Product::query()->count()),
            Stat::make('Stock Obat Aktif', ProductDetail::getTotalStock()),
            Stat::make('Stock Obat Kadaluarsa', ProductDetail::getTotalExpiredProductStock())
        ];
    }
}

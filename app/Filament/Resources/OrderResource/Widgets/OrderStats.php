<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\SellingInvoice;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Obat', Product::query()->count()),
            Stat::make('Transaksi Berhasil', SellingInvoice::query()->where('order_status', 'Pengambilan Berhasil')->count()),
            Stat::make('Menunggu Pengambilan', SellingInvoice::query()->where('order_status', 'Menunggu Pengambilan')->count()),
            Stat::make('Pengembalian', SellingInvoice::query()->where('payment_status', 'Refund')->count()),
        ];
    }
}

<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\SellingInvoice;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Menunggu Konfirmasi', SellingInvoice::query()->where('order_status', 'Menunggu Konfirmasi')->count()),
            Stat::make('Pengembalian', SellingInvoice::query()->where('order_status', 'Pengembalian')->count()),
            Stat::make('Transaksi Online Berhasil', SellingInvoice::query()->where('order_status', 'Berhasil')->count()),
            Stat::make('Transaksi Offline Berhasil', SellingInvoice::query()->where('order_status', 'Offline')->count()),
        ];
    }
}

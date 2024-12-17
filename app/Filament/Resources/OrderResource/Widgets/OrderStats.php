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
            Stat::make('Transaksi Online', SellingInvoice::query()->where('order_status', 'Pengambilan Berhasil')->count()),
            Stat::make('Transaksi Offline', SellingInvoice::query()->where('order_status', 'Offline')->count()),
            Stat::make('Transaksi Gagal', SellingInvoice::query()
                ->where('payment_status', 'Pembayaran Gagal')
                ->orWhere('order_status', 'Pengambilan Gagal')
                ->orWhere('order_status', 'Dibatalkan')
                ->count()),
            // Stat::make('Pengambilan Gagal', SellingInvoice::query()->where('order_status', 'Pengambilan Gagal')->count()),
            Stat::make('Total Pemasukan', 'Rp ' . number_format(SellingInvoice::query()
                ->where('payment_status', 'Pembayaran Berhasil')
                ->whereNotNull('order_completed')
                ->get()
                ->sum(function($invoice) {
                    return $invoice->getTotalInvoicePrice();
                }), 0, ',', '.')
            ),
        ];
    }
}

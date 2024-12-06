<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStats::class,
        ];
    }

    public function getTabs(): array 
    {
        return [
            null => Tab::make('All'),
            'Pembayaran Berhasil' => Tab::make()->query(fn ($query) => $query->where('payment_status', 'Pembayaran Berhasil')), 
            'Menunggu Pembayaran' => Tab::make()->query(fn ($query) => $query->where('payment_status', 'Menunggu Pembayaran')), 
            'Pembayaran Gagal' => Tab::make()->query(fn ($query) => $query->where('payment_status', 'Pembayaran Gagal')), 
            'Pengambilan Berhasil' => Tab::make()->query(fn ($query) => $query->where('order_status', 'Pengambilan Berhasil')), 
            'Menunggu Pengambilan' => Tab::make()->query(fn ($query) => $query->where('order_status', 'Menunggu Pengambilan')), 
            'Pengambilan Gagal' => Tab::make()->query(fn ($query) => $query->where('order_status', 'Pengambilan Gagal')), 
            'Dibatalkan' => Tab::make()->query(fn ($query) => $query->where('order_status', 'Dibatalkan')), 
            'Refund' => Tab::make()->query(fn ($query) => $query->where('order_status', 'Refund')), 
        ];
    }
}

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
            'Menunggu Konfirmasi' => Tab::make()->query(fn ($query) => $query->where('order_status', 'Menunggu Konfirmasi')), 
            'Menunggu Pengambilan' => Tab::make()->query(fn ($query) => $query->where('order_status', 'Menunggu Pengambilan')), 
            'Menunggu Pengembalian' => Tab::make()->query(fn ($query) => $query->where('order_status', 'Menunggu Pengembalian')), 
            'Pengembalian' => Tab::make()->query(fn ($query) => $query->where('order_status', 'Pengembalian')), 
            'Gagal' => Tab::make()->query(fn ($query) => $query->where('order_status', 'Gagal')), 
            'Berhasil' => Tab::make()->query(fn ($query) => $query->where('order_status', 'Berhasil')), 
            'Transaksi Offline' => Tab::make()->query(fn ($query) => $query->where('order_status', 'Offline')), 
        ];
    }
}

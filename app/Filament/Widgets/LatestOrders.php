<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use App\Models\SellingInvoice;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('order_date', 'desc')
            ->columns([
                TextColumn::make('invoice_code')
                    ->label('Kode Invoice')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('recipient_name')
                    ->label('Nama Penerima')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('order_date')
                    ->label('Tanggal Transaksi')
                    ->date('d F Y')
                    ->sortable(),
                
                    TextColumn::make('payment_status')
                    ->label('Status Transaksi')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'Pembayaran Berhasil' => 'success',
                        'Menunggu Pembayaran' => 'warning',
                        'Pembayaran Gagal' => 'danger',
                    })
                    ->sortable(),
                
                    TextColumn::make('order_status')
                        ->label('Status Transaksi')
                        ->badge()
                        ->color(fn (string $state): string => match($state) {
                            'Pengambilan Berhasil' => 'success',
                            'Menunggu Pengambilan' => 'warning',
                            'Pengambilan Gagal' => 'danger',
                            'Dibatalkan' => 'danger',
                            'Refund' => 'info',
                        })
                        ->searchable()
                        ->sortable()
            ])
            ->actions([
                Action::make('Detail')
                    ->url(fn (SellingInvoice $order): string => OrderResource::getUrl('view', ['record' => $order]))
                    ->icon('heroicon-m-eye')
            ]);
    }
}

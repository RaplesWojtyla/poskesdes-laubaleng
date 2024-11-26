<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\SellingInvoice;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
// use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = SellingInvoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Transaksi Penjualan';
    protected static ?string $pluralLabel = 'Transaksi Penjualan';
    protected static ?string $recordTitleAttribute = 'invoice_code';
    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('invoice_code')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_code')
                    ->label('Kode Invoice')
                    ->sortable(),

                TextColumn::make('recipient_name')
                    ->label('Nama Penerima')
                    ->sortable()
                    ->searchable(),
                
                TextColumn::make('order_date')
                    ->label('Tanggal Transaksi')
                    ->sortable(),
                
                TextColumn::make('order_status')
                    ->label('Status Transaksi')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'Berhasil' => 'success',
                        'Menunggu Konfirmasi' => 'info',
                        'Menunggu Pengambilan' => 'warning',
                        'Menunggu Pengembalian' => 'warning',
                        'Pengembalian' => 'danger',
                        'Gagal' => 'danger',
                        'Offline' => 'success',
                    })
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make('view')->label('Detail'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            // 'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\OrderView::route('/{record}'),
            // 'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}

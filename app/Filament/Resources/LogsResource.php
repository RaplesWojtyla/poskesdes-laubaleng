<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogsResource\Pages;
use App\Filament\Resources\LogsResource\RelationManagers;
use App\Models\Logs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LogsResource extends Resource
{
    protected static ?string $model = Logs::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?int $navigationSort = 8;

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('log_time', 'desc')
            ->columns([
                TextColumn::make('log_time')
                    ->label('Waktu Log')
                    ->date('d F Y')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('reference')
                    ->label('Referensi')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('pelaku')
                    ->label('Pelaku')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('log_target')
                    ->label('Target')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('log_description')
                    ->label('Aksi')
                    ->searchable()
                    ->sortable(),  

                TextColumn::make('old_value')
                    ->label('Nilai Lama')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'Pembayaran Berhasil' => 'success',
                        'Menunggu Pembayaran' => 'warning',
                        'Pembayaran Gagal' => 'danger',
                        'Pengambilan Berhasil' => 'success',
                        'Menunggu Pengambilan' => 'info',
                        'Pengambilan Gagal' => 'danger',
                        'Dibatalkan' => 'danger',
                        'Offline' => 'success',
                        default => 'normal'
                    })
                    ->sortable(),
                
                TextColumn::make('new_value')
                    ->label('Nilai Baru')
                    ->badge()
                    ->color(fn (string $state): string => match($state) {
                        'Pembayaran Berhasil' => 'success',
                        'Menunggu Pembayaran' => 'warning',
                        'Pembayaran Gagal' => 'danger',
                        'Pengambilan Berhasil' => 'success',
                        'Menunggu Pengambilan' => 'info',
                        'Pengambilan Gagal' => 'danger',
                        'Dibatalkan' => 'danger',
                        'Offline' => 'success',
                        default => 'normal'
                    })
                    ->sortable(),
                
                // TextColumn::make('old_value')
                //     ->label(label: 'Nilai Lama')
                //     ->sortable(),  
                
                // TextColumn::make('new_value')
                //     ->label('Nilai Baru')
                //     ->sortable(),
            ])
            ->filters(filters: [
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLogs::route('/'),
            // 'create' => Pages\CreateLogs::route('/create'),
            // 'edit' => Pages\EditLogs::route('/{record}/edit'),
        ];
    }
}

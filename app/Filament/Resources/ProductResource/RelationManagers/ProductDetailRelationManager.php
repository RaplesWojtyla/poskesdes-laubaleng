<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Carbon\Carbon;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;

class ProductDetailRelationManager extends RelationManager
{
    protected static string $relationship = 'productDetail';
    protected static ?string $title = 'Tambah Batch';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('exp_date')
                    ->required()
                    ->after(Carbon::now()->addMonths(3))
                    ->validationMessages([
                        'after' => 'Tanggal kadaluarsa obat harus lebih dari 3 bulan dari sekarang.'
                    ]),
                
                TextInput::make('stock')
                    ->label(label: 'Quantity')
                    ->required(),
                
                TextInput::make('product_buy_price')
                    ->label(label: 'Harga Beli Obat')
                    ->prefix('Rp')
                    ->numeric()
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id_product_detail')
            ->columns([
                TextColumn::make('id_product_detail')
                    ->label('Id Batch')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('exp_date')
                    ->label('Tanggal Kadaluarsa')
                    ->sortable(),
                
                TextColumn::make('stock')
                    ->label('Quantity')
                    ->sortable(),
                
                TextColumn::make('product_buy_price')
                    ->label('Harga Beli Obat')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Batch'),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    ViewAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

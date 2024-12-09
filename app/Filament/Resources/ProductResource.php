<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $recordTitleAttribute = 'product_name';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Informasi Obat')->schema([
                        TextInput::make('product_name')
                            ->label('Nama Obat')
                            ->required(),
                        
                        Select::make('description.id_category')
                            ->label('Kategori')
                            ->options(Category::all()->pluck('category', 'id_category'))
                            ->required()
                            ->searchable(),

                        Select::make('description.id_unit')
                            ->label('Unit')
                            ->options(Unit::all()->pluck('unit', 'id_unit'))
                            ->required()
                            ->searchable(),
                        
                        Select::make('description.golongan_obat')
                            ->label('Golongan Obat')
                            ->options([
                                'Bebas' => 'Bebas',
                                'Bebas Terbatas' => 'Bebas Terbatas',
                                'Keras' => 'Keras',
                                'Narkotika' => 'Narkotika'
                            ])
                            ->required()
                            ->searchable(),
                        
                        Select::make('description.type')
                            ->label('Tipe Obat')
                            ->options([
                                'Umum' => 'Umum',
                                'Resep dokter' => 'Resep dokter'
                            ])
                            ->required()
                            ->searchable(),

                        TextInput::make('description.NIE')
                            ->label('Nomor Izin Edar')
                            ->required(),
                        
                        Select::make('description.id_supplier')
                            ->label('Supplier')
                            ->options(Supplier::all()->pluck('supplier', 'id_supplier'))
                            ->required()
                            ->searchable(),

                        // TextInput::make('detail.stock')
                        //     ->label('Stok Obat')
                        //     ->numeric()
                        //     ->required(),
                        
                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'Aktif' => 'Aktif',
                                'Tidak Aktif' => 'Tidak Aktif',
                                'Expired' => 'Expired'
                            ])
                            ->required()
                            ->searchable(),

                        TextInput::make('product_sell_price')
                            ->numeric()
                            ->required()
                            ->prefix('IDR'),
                    ])->columns(3),

                    Section::make('Deskripsi Obat')->schema([
                        MarkdownEditor::make('description.deskripsi')
                            ->label('Deskripsi Obat')
                            ->columnSpan(2)
                            ->fileAttachmentsDirectory('deskripsi')
                            ->required(),
                        
                        MarkdownEditor::make('description.indication')
                            ->label('Indikasi / Manfaat / Kegunaan Obat')
                            ->columnSpan(2)
                            ->fileAttachmentsDirectory('deskripsi')
                            ->required(),
                        
                        MarkdownEditor::make('description.side_effect')
                            ->label("Efek Samping")
                            ->columnSpan(2)
                            ->fileAttachmentsDirectory('side_effect')
                            ->required(),
                        
                        MarkdownEditor::make('description.dosage')
                            ->label("Dosis Obat")
                            ->columnSpan(2)
                            ->fileAttachmentsDirectory('dosage')
                            ->required()

                    ])->columns(4),

                    Section::make('Gambar Obat')->schema([
                        FileUpload::make('description.product_img')
                            ->label('Gambar Obat')
                            ->image()
                            ->directory('product_img')
                            ->required()
                    ])
                ])->columnSpan(4),
            ])->columns(4);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product_name')
                    ->label('Nama Obat')
                    ->searchable(),

                TextColumn::make('productDescription.category.category')
                    ->label('Kategori Obat')
                    ->searchable(),
                
                TextColumn::make('productDescription.unit.unit')
                    ->label('Unit Obat')
                    ->searchable(),
                
                TextColumn::make('productDescription.golongan_obat')
                    ->label('Golongan Obat')
                    ->searchable(),
                
                TextColumn::make('productDescription.type')
                    ->label('Tipe Obat')
                    ->searchable(),
                
                TextColumn::make('productDescription.NIE')
                    ->label('Nomor Izin Edar')
                    ->searchable(),
                
                TextColumn::make('detail.stock')
                    ->label('Total Stock')
                    ->getStateUsing(function (Product $record) {
                        return $record->total_stock;
                    })
                    ->searchable(),
                
                // TextColumn::make('productDetail.exp_date')
                //     ->label('Tanggal Kadaluarsa')
                //     ->searchable(),

                TextColumn::make('nearest_exp_date')
                    ->label('Tanggal Kadaluarsa')
                    ->getStateUsing(function (Product $record) {
                        return $record->productDetail->where('stock', '>', 0)->sortBy('exp_date')->first()->exp_date ?? 'N/A';
                    })
                    ->searchable(),
                
                TextColumn::make('status')
                    ->searchable(),
            ])
            ->filters([
                // SelectFilter::make('status')
                //     // ->relationship('product', 'status')
                //     ->placeholder('All'),
                
                SelectFilter::make('category')
                    ->relationship('productDescription.category', 'category')
                    ->placeholder('Semua Kategori'),
                
                SelectFilter::make('unit')
                    ->relationship('productDescription.unit', 'unit')
                    ->placeholder('Semua Unit'),
                
                SelectFilter::make('Golongan Obat')
                    ->relationship('productDescription', 'golongan_obat')
                    ->placeholder('Semua Unit')
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    ViewAction::make()
                        ->mutateRecordDataUsing(function(array $data, $record): array {
                            $description = $record->productDescription;
                            $detail = $record->productDetail->first();

                            $data['description']['id_category'] = $description->category->id_category;
                            $data['description']['id_unit'] = $description->unit->id_unit;
                            $data['description']['golongan_obat'] = $description->golongan_obat;
                            $data['description']['type'] = $description->type;
                            $data['description']['id_supplier'] = $description->supplier->id_supplier;
                            $data['description']['deskripsi'] = $description->deskripsi;
                            $data['description']['indication'] = $description->indication;
                            $data['description']['side_effect'] = $description->side_effect;
                            $data['description']['dosage'] = $description->dosage;
                            $data['description']['NIE'] = $description->NIE;
                            $data['description']['product_img'] = $description->product_img;
                            $data['detail']['stock'] = $detail->stock;
                            $data['detail']['exp_date'] = $detail->exp_date;
                            $data['detail']['product_buy_price'] = $detail->product_buy_price;

                            return $data;
                        }),
                    DeleteAction::make()
                ]),
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
            'productDetail' => RelationManagers\ProductDetailRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

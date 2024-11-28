<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductDescription;
use App\Models\ProductDetail;
use Exception;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $product = $this->record;
        $description = $product->productDescription;
        $detail = $product->productDetail->first();
        
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
        $data['detail']['id_product_detail'] = $detail->id_product_detail;
        $data['detail']['stock'] = $detail->stock;
        $data['detail']['exp_date'] = $detail->exp_date;
        $data['detail']['product_buy_price'] = $detail->product_buy_price;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        try {
            return DB::transaction(function() use ($data): array {
                $product = $this->record;
                $description = $product->productDescription;
                $detail = $product->productDetail->first();

                if ($data['product_sell_price'] < 1) 
                {
                    throw ValidationException::withMessages([
                        'product_sell_price' => 'Harga jual produk tidak boleh kurang dari atau sama dengan 0'
                    ]);
                }
                
                if ($data['detail']['product_buy_price'] < 1) 
                {
                    throw ValidationException::withMessages([
                        'product_sell_price' => 'Harga beli produk tidak boleh kurang dari atau sama dengan 0'
                    ]);
                }

                $description->update([
                    'id_category' => $data['description']['id_category'],
                    'id_unit' => $data['description']['id_unit'],
                    'golongan_obat' => $data['description']['golongan_obat'],
                    'id_supplier' => $data['description']['id_supplier'],
                    'deskripsi' => $data['description']['deskripsi'],
                    'indication' => $data['description']['indication'],
                    'side_effect' => $data['description']['side_effect'],
                    'dosage' => $data['description']['dosage'],
                    'NIE' => $data['description']['NIE'],
                    'type' => $data['description']['type'],
                    'product_img' => $data['description']['product_img'],
                ]);

                $detail->update([
                    'exp_date' => $data['detail']['exp_date'],
                    'stock' => $data['detail']['stock'],
                    'product_buy_price' => $data['detail']['product_buy_price'],
                ]);

                unset($data['description'], $data['detail']);
                // dd($data);
                
                return $data;
            });
        } catch(ValidationException $e) {
            Notification::make()
                ->title('Error')
                ->body('Input tidak valid: ' . $e->getMessage())
                ->danger()
                ->send();
            
            throw $e;
        } catch (Exception $e) {
            Notification::make()
                ->title('Error')
                ->body('Gagal mengubah data: ' . $e->getMessage())
                ->danger()
                ->send();

            throw $e;
        }
    }
}

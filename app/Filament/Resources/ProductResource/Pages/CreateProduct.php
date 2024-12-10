<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\ProductDescription;
use App\Models\ProductDetail;
use Exception;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        try {
            return DB::transaction(function() use ($data) {
                $id_description = Str::uuid();
                $id_product = Str::uuid();
                $id_detail = Str::uuid();

                ProductDescription::create([
                    'id_product_description' => $id_description,
                    'id_category' => $data['description']['id_category'],
                    'id_unit' => $data['description']['id_unit'],
                    'golongan_obat' => $data['description']['golongan_obat'],
                    'deskripsi' => $data['description']['deskripsi'],
                    'indication' => $data['description']['indication'],
                    'side_effect' => $data['description']['side_effect'],
                    'dosage' => $data['description']['dosage'],
                    'NIE' => $data['description']['NIE'],
                    'type' => $data['description']['type'],
                    'product_img' => $data['description']['product_img'],
                ]);

                // $product_detail = [
                //     'id_product_detail' => $id_detail,
                //     'id_product' => $id_product,
                //     'exp_date' => $data['detail']['exp_date'],
                //     'stock' => $data['detail']['stock'],
                //     'product_buy_price' => $data['detail']['product_buy_price'],
                // ];

                unset($data['description'], $data['detail']);
                $data['id_product'] = $id_product;
                $data['id_product_description'] = $id_description;

                // session()->put('product_detail_data', $product_detail);

                return $data;
            });
        } catch (Exception $e) {
            Notification::make()
                ->title('Error')
                ->body('Gagal menyimpan data obat: ' . $e->getMessage())
                ->danger()
                ->send();
            
            throw $e;
        }
    }

    public static function afterCreate() {
        // try {
        //     DB::transaction(function()  {
        //         $product_detail = session()->pull('product_detail_data');

        //         ProductDetail::create([
        //             'id_product_detail' => $product_detail['id_product_detail'],
        //             'id_product' => $product_detail['id_product']       ,
        //             'exp_date' => $product_detail['exp_date'],
        //             'stock' => $product_detail['stock'],
        //             'product_buy_price' => $product_detail['product_buy_price'],
        //         ]);
        //     });
        // } catch (Exception $e) {
        //     Notification::make()
        //         ->title('Error')
        //         ->body('Gagal menyimpan data obat: ' . $e->getMessage())
        //         ->danger()
        //         ->send();
            
        //     throw $e;
        // }
    }
}

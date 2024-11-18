<?php

namespace App\Filament\Resources\CashierResource\Pages;

use App\Filament\Resources\CashierResource;
use App\Models\User;
use Exception;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateCashier extends CreateRecord
{
    protected static string $resource = CashierResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        try {
            return DB::transaction(function() use ($data) {
                $uuid = Str::uuid();

                User::create([
                    'id_user' => $uuid,
                    'email' => $data['user']['email'],
                    'name' => $data['user']['name'],
                    'role' => 'cashier',
                    'email_verified_at' => $data['user']['email_verified_at'],
                    'password' => bcrypt($data['user']['password'])
                ]);

                unset($data['user']);
                $data['id_user'] = $uuid;

                return $data;
            });
        } catch (Exception $e) {
            throw new \RuntimeException('Gagal menyimpan data: ' . $e->getMessage());
        }
    }
}

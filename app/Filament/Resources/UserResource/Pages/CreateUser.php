<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Customer;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
        
    // }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        try {
            return DB::transaction(function() use ($data) {
                $uuid = Str::uuid();

                User::create([
                    'id_user' => $uuid,
                    'email' => $data['user']['email'],
                    'name' => $data['user']['name'],
                    'role' => 'user',
                    'email_verified_at' => $data['user']['email_verified_at'],
                    'password' => bcrypt($data['user']['password']),
                ]);
                
                unset($data['user']);
                $data['id_user'] = $uuid;

                return $data;
            });
        } catch (\Exception $e) {
            throw new \RuntimeException('Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    protected function beforeCreate() {

    }
}

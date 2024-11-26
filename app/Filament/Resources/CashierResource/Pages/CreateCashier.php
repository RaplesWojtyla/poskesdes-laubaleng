<?php

namespace App\Filament\Resources\CashierResource\Pages;

use App\Filament\Resources\CashierResource;
use App\Models\User;
use Exception;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CreateCashier extends CreateRecord
{
    protected static string $resource = CashierResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        try {
            return DB::transaction(function() use ($data) {
                $uuid = Str::uuid();
                
                if 
                (
                    User::where('email', $data['user']['email'])
                        ->where('id_user', '!=', $uuid)
                        ->exists()) 
                {
                    throw ValidationException::withMessages([
                        'user.email' => 'Email telah digunakan'
                    ]);
                }

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
        } catch(ValidationException $e) {
            Notification::make()
                ->title('Error')
                ->body($e->getMessage())
                ->danger()
                ->send();
            
            throw $e;
        } catch (Exception $e) {
            Notification::make()
                ->title('Error')
                ->body('Gagal menyimpan data: ' . $e->getMessage())
                ->danger()
                ->send();
            
            throw $e;
        }
    }
}

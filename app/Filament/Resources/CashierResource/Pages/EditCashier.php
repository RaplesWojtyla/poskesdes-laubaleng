<?php

namespace App\Filament\Resources\CashierResource\Pages;

use App\Filament\Resources\CashierResource;
use App\Models\User;
use Exception;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EditCashier extends EditRecord
{
    protected static string $resource = CashierResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $cashier = $this->record;
        $user = $cashier->user;
        // dd($user);
        
        $data['user']['id_user'] = $data['id_user'];
        $data['user']['email'] = $user->email;
        $data['user']['name'] = $user->name;
        $data['user']['email_verified_at'] = $user->email_verified_at;
        $data['user']['password'] = '';

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        try {
            return DB::transaction(function() use ($data): array {
                $cashier = $this->record;

                if 
                (
                    User::where('email', $data['user']['email'])
                        ->where('id_user', '!=', $cashier->id_user)
                        ->exists()
                ) 
                {
                    throw ValidationException::withMessages([
                        'user.email' => 'Email telah digunakan'
                    ]);
                }

                if (isset($data['user']))
                {
                    $cashier->user->update([
                        'email' => $data['user']['email'],
                        'name' => $data['user']['name'],
                        'password' => !empty($data['user']['password']) ? bcrypt($data['user']['password']) : $cashier->user->password,
                    ]);
                }

                unset($data['user']);

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

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

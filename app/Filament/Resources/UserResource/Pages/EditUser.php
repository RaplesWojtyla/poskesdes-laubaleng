<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $user = User::find($data['id_user']);
        
        $data['user']['id_user'] = $data['id_user'];
        $data['user']['email'] = $user->email;
        $data['user']['name'] = $user->name;
        $data['user']['email_verified_at'] = $user->email_verified_at;
        $data['user']['password'] = '';

        return $data;
    }
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        dd($data);
        $user = User::find($data['id_user']);

        $user::update([
            'email' => $data['user']['email'],
            'name' => $data['user']['name'],
        ]);

        unset($data['user']);

        return $data;
    }
}

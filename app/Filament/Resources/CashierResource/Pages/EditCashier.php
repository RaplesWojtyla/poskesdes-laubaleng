<?php

namespace App\Filament\Resources\CashierResource\Pages;

use App\Filament\Resources\CashierResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCashier extends EditRecord
{
    protected static string $resource = CashierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

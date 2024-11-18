<?php

namespace App\Filament\Resources\CashierResource\Pages;

use App\Filament\Resources\CashierResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCashiers extends ListRecords
{
    protected static string $resource = CashierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

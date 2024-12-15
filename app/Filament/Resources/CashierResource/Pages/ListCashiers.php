<?php

namespace App\Filament\Resources\CashierResource\Pages;

use App\Filament\Resources\CashierResource;
use App\Filament\Resources\CashierResource\Widgets\CashierStats;
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
    
    protected function getHeaderWidgets(): array
    {
        return [
            CashierStats::class
        ];
    }
}

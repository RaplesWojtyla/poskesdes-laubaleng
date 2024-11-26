<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\SellingInvoice;
use App\Models\SellingInvoiceDetail;
use Filament\Actions;
use Filament\Resources\Pages\Page;

class OrderView extends Page
{
    public $order;
    protected static string $resource = OrderResource::class;

    protected static string $view = 'filament.resources.order-resource.pages.order-view';
    protected static ?string $title = 'Detail Transaksi';

    public function mount($record) {
        $this->order = SellingInvoice::findOrFail($record);
        // dd($this->order);
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}

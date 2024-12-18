<?php

namespace App\Http\Controllers;

use App\Filament\Resources\OrderResource;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class OrderReportController extends Controller
{
    public function showReport(Request $request)
    {
        $orders = OrderResource::getEloquentQuery()
			->where('payment_status', 'Pembayaran Berhasil')
            ->whereNotNull('order_completed')
            ->when(
                $request->input('from'),
                fn ($query, $date) => $query->whereDate('order_completed', '>=', $date),
            )
            ->when(
                $request->input('until'),
                fn ($query, $date) => $query->whereDate('order_completed', '<=', $date),
            )
			->orderBy('order_completed', 'desc')
            ->get();

        return view('reports.laporan-pemasukan', ['orders' => $orders]);
    }
}

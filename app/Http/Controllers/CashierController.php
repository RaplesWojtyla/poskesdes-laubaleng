<?php

namespace App\Http\Controllers;

use App\Models\SellingInvoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashierController extends Controller
{
    public function historyTransaction()
    {
        $histories = SellingInvoice::where('cashier_name', auth()->user()->name)
            ->where(function ($query) {
                $query->where('order_status', 'Pengambilan Berhasil')
                    ->orWhere('recipient_payment', 'Offline')
                    ->orWhere('order_status', 'Pengambilan Gagal')
                    ->orWhere('order_status', 'Dibatalkan')
                    ->orWhere('order_status', 'Refund');
            })
            ->orderBy('invoice_code', 'desc')
            ->get();

        $total = SellingInvoice::where('order_status', 'Menunggu Pengambilan')->count();
    
        return view('cashier.history-transaction', [
            'histories' => $histories, 
            'total' => $total
        ]);
    }

    public function pendingOrders()
    {
        $pendingOrders = SellingInvoice::where('payment_status', 'Pembayaran Berhasil')
            ->where('order_status', 'Menunggu Pengambilan')
            ->orderBy('order_date', 'desc')
            ->get();

        $total = $pendingOrders->count();

        return view('cashier.pending-orders', [
            'pendingOrders' => $pendingOrders,
            'total' => $total
        ]);
    }

    public function onlineOrders()
    {
        $onlineOrders = SellingInvoice::where('payment_status', 'Menunggu Pembayaran')
            ->orderBy('order_date', 'desc')
            ->get();

        $total = $onlineOrders->count();

        return view('cashier.online-orders', [
            'onlineOrders' => $onlineOrders,
            'total' => $total
        ]);
    }


    public function successOrder($id_selling_invoice)
    {
        DB::beginTransaction();
        try {
            $order = SellingInvoice::findOrFail($id_selling_invoice);

            // foreach ($order->sellingInvoiceDetail as $produk) 
            // {
            //     foreach (Product::where('product_name', $produk->product_name)->first()->productDetail as $detail) 
            //     {
            //         if ($detail->product_stock == 0) 
            //         {
            //             if (Product::where('product_name', $produk->product_name)->first()->productDetail()->count() > 1) {
            //                 $detail->delete();
            //             }
            //         }
            //     }
            // }

            // Ubah status menjadi 'Berhasil'
            $order->order_status = 'Pengambilan Berhasil';
            $order->save();

            DB::commit();
            // Redirect ke halaman atau tindakan yang sesuai
            return redirect()->back()->with('success', 'Status berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', "Produk tidak ditemukan.");
        }
    }

    public function failOrder($id_selling_invoice)
    {
        try {
            DB::beginTransaction();
            $order = SellingInvoice::findOrFail($id_selling_invoice);

            DB::select("CALL order_fail(?, ?, ?)", array($id_selling_invoice, auth()->user()->username, "Telah Melewati Batas Waktu Pengambilan, Tidak Akan Dilakukan Refund!!"));

            foreach ($order->sellingInvoiceDetail as $detail) {
                $id_product = Product::where('product_name', $detail->product_name)->first()->id_product;
                // dd($id_product);
                DB::select("CALL stock_back(?, ?)", array($detail->quantity, $id_product));
            }
            DB::commit();

            // Redirect ke halaman atau tindakan yang sesuai
            return redirect()->back()->with('success', 'Status berhasil diperbarui.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }
    }

    public function updateStatus(Request $request, $id_selling_invoice)
    {
        try {
            $order = SellingInvoice::findOrFail($id_selling_invoice);


            if ($request->status == 'terima') {
                DB::select("CALL order_success(?, ?)", array($id_selling_invoice, auth()->user()->username));

                return redirect()->back()->with('success', 'Pesanan berhasil diterima.');
            } else if ($request->status == 'tolak') {
                try {
                    $request->validate([
                        'alasanTolak' => ['required', 'string', 'min:10', 'regex:/^[a-zA-Z0-9 ]+$/', 'max:255']
                    ]);
                    DB::beginTransaction();

                    DB::select("CALL order_fail(?, ?, ?)", array($id_selling_invoice, auth()->user()->username, $request->alasanTolak));

                    foreach ($order->sellingInvoiceDetail as $detail) {
                        $id_product = Product::where('product_name', $detail->product_name)->first()->id_product;
                        // dd($id_product);
                        DB::select("CALL stock_back(?, ?)", array($detail->quantity, $id_product));
                    }

                    DB::commit();
                    return redirect()->back()->with('success', 'Pesanan telah ditolak!.');
                } catch (\Exception $e) {
                    // throw $e;
                    return redirect()->back()->with('error', 'Terjadi Kesalahan Penolakan');
                }
            } else if ($request->status == 'refund') {
                try {
                    DB::beginTransaction();
                    $request->validate([
                        'alasanRefund' => ['required', 'string', 'min:10', 'regex:/^[a-zA-Z0-9 ]+$/', 'max:255']
                    ]);
                    DB::select("CALL order_refund(?, ?, ?)", array($id_selling_invoice, auth()->user()->username, $request->alasanRefund));


                    foreach ($order->sellingInvoiceDetail as $detail) {
                        $id_product = Product::where('product_name', $detail->product_name)->first()->id_product;
                        // dd($id_product);
                        DB::select("CALL stock_back(?, ?)", array($detail->quantity, $id_product));
                    }

                    DB::commit();
                    return redirect()->back()->with('success', 'Pesanan akan diproses untuk pengembalian.');
                } catch (\Exception $e) {
                    // throw $e;
                    return redirect()->back()->with('error', 'Terjadi Kesalahan Refund');
                }
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
        }
    }
    public function informasi_pembayaran(Request $request)
    {
        return view('kasir.show-image', [
            'title' => 'Bukti Pembayaran',
            'root' => 'bukti-pembayaran',
            'file' => $request->img,
        ]);
    }

    public function resep_dokter(Request $request)
    {
        return view('kasir.show-image', [
            'title' => 'Resep Dokter',
            'root' => 'resep-dokter',
            'file' => $request->img,
        ]);
    }

    public function refund(Request $request)
    {
        return view('kasir.show-image', [
            'title' => 'Refund',
            'root' => 'refund',
            'file' => $request->img,
        ]);
    }
}

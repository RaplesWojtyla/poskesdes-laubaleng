<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <h1 class="text-4xl font-bold text-slate-500">My Orders</h1>
  <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
    <div class="-m-1.5 overflow-x-auto">
      <div class="p-1.5 min-w-full inline-block align-middle">
        <div class="overflow-hidden">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
              <tr>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Kode Invoice</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal Transaksi</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order Status</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status Pembayaran</th>
                <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Order Amount</th>
                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($myOrders as $order)
              <?php 
                $order_status = '';
                $payment_status = '';

                if ($order->order_status == 'Menunggu Pengambilan') $order_status = '<span class="bg-orange-500 py-1 px-3 rounded text-white shadow">Menunggu Pengambilan</span>';
                elseif ($order->order_status == 'Pengambilan Gagal') $order_status = '<span class="bg-red-600 py-1 px-3 rounded text-white shadow">Pengambilan Gagal</span>';
                elseif ($order->order_status == 'Refund') $order_status = '<span class="bg-red-400 py-1 px-3 rounded text-white shadow">Refund</span>';
                elseif ($order->order_status == 'Pengambilan Berhasil') $order_status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Pengambilan Berhasil</span>';
                elseif ($order->order_status == 'Dibatalkan') $order_status = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Dibatalkan</span>';
                
                if ($order->payment_status == 'Menunggu Pembayaran') 
                {
                  $order_status = '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Menunggu Pembayaran</span>';
                  $payment_status = '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Menunggu Pembayaran</span>';
                }
                elseif ($order->payment_status == 'Pembayaran Gagal') $payment_status = '<span class="bg-red-600 py-1 px-3 rounded text-white shadow">Pembayaran Gagal</span>';
                elseif ($order->payment_status == 'Pembayaran Berhasil') $payment_status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Pembayaran Berhasil</span>';
              ?>
              <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">{{ $order->invoice_code }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ date('d F Y',strtotime($order->order_date)) }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{!! $order_status !!}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{!! $payment_status !!}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">Rp {{ number_format($order->sellingInvoiceDetail->sum(function ($item) {return $item->product_sell_price * $item->quantity;}), 2, ',', '.') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                  <a href="/my-orders/{{ $order->id_selling_invoice }}" class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">View Details</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      {{ $myOrders->links() }}
    </div>
  </div>
</div>
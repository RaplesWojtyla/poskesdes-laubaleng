<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <h1 class="text-4xl font-bold text-slate-500">Order Details</h1> 
  <span class="text-3xl py-5 font-bold text-black-500"> {{ $orderDetail->invoice_code }}</span>

  <!-- Grid -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-5">
    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Nama Penerima
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">
            <div>{{ $orderDetail->recipient_name }}</div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 22h14" />
            <path d="M5 2h14" />
            <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
            <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Tanggal Transaksi
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">
            <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200">
            {{ date('d F Y',strtotime($orderDetail->order_date)) }}
            </h3>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
            <path d="m12 12 4 10 1.7-4.3L22 16Z" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Order Status
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">
            @if($orderDetail->order_status == 'Menunggu Pengambilan')
              <span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">{{ $orderDetail->order_status }}</span>
            @elseif($orderDetail->order_status == 'Pengambilan Gagal')
              <span class="bg-red-600 py-1 px-3 rounded text-white shadow">{{ $orderDetail->order_status }}</span>
            @elseif($orderDetail->order_status == 'Dibatalkan')
              <span class="bg-red-700 py-1 px-3 rounded text-white shadow">{{ $orderDetail->order_status }}</span>
            @elseif($orderDetail->order_status == 'Refund')
              <span class="bg-red-500 py-1 px-3 rounded text-white shadow">{{ $orderDetail->order_status }}</span>
            @elseif($orderDetail->order_status == 'Pengambilan Berhasil')
              <span class="bg-green-500 py-1 px-3 rounded text-white shadow">{{ $orderDetail->order_status }}</span>
            @else
              <span class="bg-orange-500 py-1 px-3 rounded text-white shadow">Menunggu Pembayaran</span>
            @endif
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12s2.545-5 7-5c4.454 0 7 5 7 5s-2.546 5-7 5c-4.455 0-7-5-7-5z" />
            <path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
            <path d="M21 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2" />
            <path d="M21 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Status Pembayaran
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">
            @if ($orderDetail->payment_status == 'Menunggu Pembayaran')
              <span class="bg-orange-500 py-1 px-3 rounded text-white shadow">{{ $orderDetail->payment_status }}</span>
            @elseif ($orderDetail->payment_status == 'Pembayaran Gagal')
              <span class="bg-red-600 py-1 px-3 rounded text-white shadow">{{ $orderDetail->payment_status }}</span>
            @elseif ($orderDetail->payment_status == 'Pembayaran Berhasil')
              <span class="bg-green-500 py-1 px-3 rounded text-white shadow">{{ $orderDetail->payment_status }}</span>
            @endif
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Grid -->

  <div class="flex flex-col md:flex-row gap-4 mt-4">
    <div class="md:w-3/4">
      <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
        <table class="w-full">
          <thead>
            <tr>
              <th class="text-left font-semibold">Nama Produk</th>
              <th class="text-left font-semibold">Harga</th>
              <th class="text-left font-semibold">Kuantitas</th>
              <th class="text-left font-semibold">Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orderDetail->sellingInvoiceDetail as $detail)
            <tr wire:key="{{ $detail->product->id_product }}">
              <td class="py-4">
                <a href="/products/{{ $detail->product->id_product }}">
                  <div class="flex items-center">
                    <img class="h-16 w-16 mr-4" src="{{ url('storage', $detail->product->productDescription->product_img) }}" alt="Product image">
                    <span class="font-semibold">{{ $detail->product_name }}</span>
                  </div>
                </a>
              </td>
              <td class="py-4">Rp {{ number_format($detail->product_sell_price, 2, ',', '.') }}</td>
              <td class="py-4">
                <span class="text-center w-8">{{ $detail->quantity }}</span>
              </td>
              <td class="py-4">Rp {{ number_format($detail->product_sell_price * $detail->quantity, 2) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      @if($orderDetail->resep_dokter != null)
      <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
        <h1 class="font-3xl font-bold text-slate-500 mb-3">Resep Dokter</h1>
        <div class="flex justify-center items-center">
          <img src="{{ url('storage', $orderDetail->resep_dokter) }}" alt="Prescription image" class="max-w-full h-auto">
        </div>
      </div>
      @endif

    </div>
    <div class="md:w-1/4">
      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold mb-4">Rincian Pesanan</h2>
        <div class="flex justify-between mb-2">
          <span>Subtotal</span>
          <span>Rp {{ number_format($orderDetail->getTotalInvoicePrice(), 2, ',', '.') }}</span>
        </div>
        <div class="flex justify-between mb-2">
          <span>Biaya Lainnya</span>
          <span>Rp 0,00</span>
        </div>
        <hr class="my-2">
        <div class="flex justify-between mb-2">
          <span class="font-semibold">Total</span>
          <span class="font-semibold">Rp {{ number_format($orderDetail->getTotalInvoicePrice(), 2, ',', '.') }}</span>
        </div>

        @if($orderDetail->payment_status == 'Menunggu Pembayaran')
        <div class="mt-6">
          <button id="pay-button" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
            Bayar
          </button>
        </div>
        @endif
        
      </div>
    </div>
  </div>
</div>

@section('scripts')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $orderDetail->snap_token }}', {
          // Optional
          onSuccess: function(result){
            // /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            console.log('onSuccess' + JSON.stringify(result));
            window.location.href = '/payment-success?order_id=' + result.order_id;
          },
          // Optional
          onPending: function(result){
            // /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            // window.location.href = '/success?order_id=' + result.order_id;
          },
          // Optional
          onError: function(result){
            // /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
            window.location.href = '/cancel?order_id={{ $orderDetail->invoice_code }}';
          },
          onClose: function() {
            // For example: when customer close the payment screen
            // window.location.href = '/success?order_id=' + result.order_id;
          },
        });
      };
    </script>
@endsection
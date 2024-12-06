<x-filament-panels::page>

    <div class="flex justify-between items-start space-x-6">
        <!-- Bagian Kiri -->
        <div class="w-[60%] mr-2">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $order->invoice_code }}</h1>
            <table class="w-full mt-4 border-collapse border border-gray-300 dark:border-gray-700 shadow-sm">
                <thead>
                    <tr class="bg-gray-200 dark:bg-gray-800">
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 w-[10%]">No</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 w-[30%]">Nama</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 w-[10%]">Jumlah</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 w-[25%]">Harga</th>
                        <th class="border border-gray-300 dark:border-gray-700 px-4 py-2 w-[25%]">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $totalPrice = 0; ?>
                    @foreach ($order->sellingInvoiceDetail as $index => $detailOrder)
                    <?php $totalPrice += $detailOrder->quantity * $detailOrder->product_sell_price ?>
                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2">{{ $detailOrder->product_name }}</td>
                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-center">{{ $detailOrder->quantity }}</td>
                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-right">Rp {{ number_format($detailOrder->product_sell_price, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 dark:border-gray-700 px-4 py-2 text-right">Rp {{ number_format($detailOrder->quantity * $detailOrder->product_sell_price, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                <p class="text-lg"><strong>Total Harga:</strong> Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>
                <p class="text-lg"><strong>Kasir:</strong> {{ $order->cashier_name }}</p>
                <p class="text-lg"><strong>Status:</strong> {{ $order->order_status == null ? 'Menunggu Pembayaran' : $order->order_status }}</p>
            </div>
        </div>
    
        <!-- Bagian Kanan -->
        <div class="w-[40%] bg-gray-100 dark:bg-gray-800 p-4 rounded-md shadow-sm">
            <p class="text-lg"><strong>Pelanggan:</strong> {{ $order->recipient_name }}</p>
            <p class="text-lg"><strong>Nomor HP:</strong> {{ $order->recipient_phone }}</p>
            <p class="text-lg"><strong>Transaksi Selesai:</strong> {{ date('d F Y',strtotime($order->order_completed)) }}</p>
            <p class="text-lg uppercase"><strong>Metode Pembayaran:</strong> {{ $order->recipient_payment === 'other_qris' ? 'qris' : $order->recipient_payment }}</p>
        </div>
    </div>

    {{--
    <div class="absolute w-full h-full top-0 left-0 flex justify-center items-center backdrop-brightness-75 z-10">
        <div
            class="w-[70%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-6 overflow-auto">
            <div class="flex justify-between items-center">
                <button type="button"
                    class="bg-mainColor py-1 px-4 text-white font-semibold rounded-md">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali
                </button>

                <p class="font-bold">TESTTT</p>

                <div class="flex gap-2 items-center">
                    <i class="text-yellow-600 fa-solid fa-circle"></i>
                    <p class="font-bold">TESTTT</p>
                </div>
            </div>

            <div class="px-8 py-2 w-[100%] flex justify-between">
                <div class="w-[70%]">
                    <div class="flex flex-col gap-8 overflow-y-auto h-72">
                        <table class="w-full">
                            <tr
                                class="border-2 border-b-mainColor border-transparent text-mainColor font-bold w-[100%]">
                                <td class="w-[10%] pb-2 text-center">No</td>
                                <td class="w-[30%] pb-2">Nama</td>
                                <td class="w-[10%] pb-2 text-center">Jumlah</td>
                                <td class="w-[25%] pb-2 text-center">Harga</td>
                                <td class="w-[25%] pb-2">Total</td>
                            </tr>
                            <tr>
                                <td class="py-2 text-center">TESTTT</td>
                                <td class="py-2">TESTTT</td>
                                <td class="py-2 text-center">TESTTT</td>
                                <td class="py-2 text-center">Rp
                                    TESTTT</td>
                                <td class="py-2">Rp
                                    TESTTT</td>
                            </tr>
                        </table>
                    </div>

                    <div class="flex flex-col gap-2 py-2">
                        <hr class="border-2 border-transparent border-b-mainColor">
                        <div class="flex font-bold gap-2">
                            <p class="w-28">Total Harga</p>
                            <p>:</p>
                            <p class="text-secondaryColor">Rp
                                TESTTT</p>
                        </div>
                        <div class="flex font-bold gap-2">
                            <p class="w-28">Kasir</p>
                            <p>:</p>
                            <p class="text-mainColor">TESTTT</p>
                        </div>

                        <div class="flex font-bold gap-2">
                            <p class="w-28">Alasan Gagal</p>
                            <p>:</p>
                            <p class="text-mainColor w-[70%]">TESTTT</p>
                        </div>
                    </div>
                </div>

                <div class="w-[25%]">
                    <p class="text-center font-bold text-mainColor pb-2">Keterangan</p>
                    <hr class="border-2 border-transparent border-b-mainColor">
                    <div class="py-2">
                        <p class="font-bold">Pelanggan :</p>
                        <p>TESTINGGG</p>
                        <p class="font-bold">Nomor HP :</p>
                        <p>TESTINGGG</p>
                        <p class="font-bold">Tanggal Pengambilan :</p>

                        <p>TESTINGGG</p>
                        <p class="font-bold">Metode Pembayaran :</p>
                        <p>TESTINGGG</p>
                        <p class="font-bold">Bukti Pembayaran :</p>
                        <a href="#" target="_blank"
                            class="text-blue-600 underline">TESTINGGG</a>
                        <p class="font-bold">Catatan :</p>
                        <p>TESTINGGG</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    --}}

</x-filament-panels::page>

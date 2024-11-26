<x-filament-panels::page>

    <div class="flex justify-between items-start space-x-6">
        <!-- Bagian Kiri -->
        <div class="w-[70%] mr-2">
            <h1 class="text-xl font-bold">{{ $order->invoice_code }}</h1>
            <table class="w-full mt-2 border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-200 px-4 py-2 w-[10%]">No</th>
                        <th class="border border-gray-200 px-4 py-2 w-[30%]">Nama</th>
                        <th class="border border-gray-200 px-4 py-2 w-[10%]">Jumlah</th>
                        <th class="border border-gray-200 px-4 py-2 w-[25%]">Harga</th>
                        <th class="border border-gray-200 px-4 py-2 w-[25%]">Total</th>
                    </tr>
                </thead>
                <tbody>
					<?php $totalPrice = 0; ?>
					@foreach ($order->sellingInvoiceDetail as $index => $detailOrder)
					<?php $totalPrice += $detailOrder->quantity * $detailOrder->product_sell_price ?>
                    <tr>
                        <td class="border border-gray-200 px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $detailOrder->product_name }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $detailOrder->quantity }}</td>
                        <td class="border border-gray-200 px-4 py-2">Rp {{ number_format($detailOrder->product_sell_price, 0, ',', '.') }}</td>
                        <td class="border border-gray-200 px-4 py-2">Rp {{ number_format($detailOrder->quantity * $detailOrder->product_sell_price, 0, ',', '.') }}</td>
                    </tr>
					@endforeach
                </tbody>
            </table>
            <div class="mt-2">
                <p><strong>Total Harga:</strong> Rp {{ number_format($totalPrice, 0, ',', '.') }}</p>
                <p><strong>Kasir:</strong> {{ $order->cashier_name }}</p>
                <p><strong>Status:</strong> {{ $order->order_status }}</p>
            </div>
        </div>
	
        <!-- Bagian Kanan -->
        <div class="w-[25%] bg-gray-100 p-4 rounded-md">
            <p><strong>Pelanggan:</strong> {{ $order->recipient_name }}</p>
            <p><strong>Nomor HP:</strong> {{ $order->recipient_phone }}</p>
            <p><strong>Tanggal Pengambilan:</strong> {{ $order->order_completed }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ $order->recipient_bank }}</p>
            <p><strong>Bukti Pembayaran:</strong> <a href="#" class="text-blue-500 underline">{{ $order->recipient_payment }}</a></p>
            <p><strong>Catatan:</strong> Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>
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

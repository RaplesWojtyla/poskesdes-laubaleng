<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="flex items-center font-poppins dark:bg-gray-800 ">
        <div class="justify-center flex-1 max-w-6xl px-4 py-4 mx-auto bg-white border rounded-md dark:border-gray-900 dark:bg-gray-900 md:py-10 md:px-10">
            <div>
                <h1 class="px-4 mb-8 text-2xl font-semibold tracking-wide text-gray-700 dark:text-gray-300 ">
                    Pembayaran Telah Diterima. Silahkan Lakukan Pengambilan Obat </h1>
                <div class="flex border-b border-gray-200 dark:border-gray-700  items-stretch justify-start w-full h-full px-4 mb-8 md:flex-row xl:flex-col md:space-x-6 lg:space-x-8 xl:space-x-0">
                    <div class="flex items-start justify-start flex-shrink-0">
                        <div class="flex items-center justify-center w-full pb-6 space-x-4 md:justify-start">
                            <div class="flex flex-col items-start justify-start space-y-2">
                                <p class="text-lg font-semibold leading-4 text-left text-gray-800 dark:text-gray-400">
                                    {{ $transaction->recipient_name }}</p>
                                <p class="text-sm leading-4 cursor-pointer dark:text-gray-400">No Telepon: {{ $transaction->recipient_phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap items-center pb-4 mb-10 border-b border-gray-200 dark:border-gray-700">
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <p class="mb-2 text-sm leading-5 text-gray-600 dark:text-gray-400 ">
                            Kode Invoice: </p>
                        <p class="text-base font-semibold leading-4 text-gray-800 dark:text-gray-400">
                            {{ $transaction->invoice_code }}</p>
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <p class="mb-2 text-sm leading-5 text-gray-600 dark:text-gray-400 ">
                            Tanggal Transaksi: </p>
                        <p class="text-base font-semibold leading-4 text-gray-800 dark:text-gray-400">
                        {{ date('d F Y',strtotime($transaction->order_date)) }}</p>
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <p class="mb-2 text-sm font-medium leading-5 text-gray-800 dark:text-gray-400 ">
                            Total: </p>
                        <p class="text-base font-semibold leading-4 text-blue-600 dark:text-gray-400">
                            Rp {{ number_format($totalPrice, '2', ',', '.')}}</p>
                    </div>
                    <div class="w-full px-4 mb-4 md:w-1/4">
                        <p class="mb-2 text-sm leading-5 text-gray-600 dark:text-gray-400 ">
                            Metode Pembayaran: </p>
                        <p class="text-base font-semibold leading-4 uppercase text-gray-800 dark:text-gray-400 ">
                            {{ $transaction->recipient_payment == 'other_qris' ? 'qris' : $transaction->recipient_payment }} </p>
                    </div>
                </div>
                <div class="px-4 mb-10">
                    <div class="flex flex-col items-stretch justify-center w-full space-y-4 md:flex-row md:space-y-0 md:space-x-8">
                        <div class="flex flex-col w-full space-y-6 ">
                            <h2 class="mb-2 text-xl font-semibold text-gray-700 dark:text-gray-400">Order details</h2>
                            <div class="flex flex-col items-center justify-center w-full pb-4 space-y-4 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex justify-between w-full">
                                    <p class="text-base leading-4 text-gray-800 dark:text-gray-400">Subtotal</p>
                                    <p class="text-base leading-4 text-gray-600 dark:text-gray-400">Rp {{ number_format($totalPrice, '2', ',', '.') }}</p>
                                </div>
                                <div class="flex items-center justify-between w-full">
                                    <p class="text-base leading-4 text-gray-800 dark:text-gray-400">Discount
                                    </p>
                                    <p class="text-base leading-4 text-gray-600 dark:text-gray-400">Rp 0,00</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between w-full">
                                <p class="text-base font-semibold leading-4 text-gray-800 dark:text-gray-400">Total</p>
                                <p class="text-base font-semibold leading-4 text-gray-600 dark:text-gray-400">Rp {{number_format($totalPrice, '2', ',', '.') }} </p>
                            </div>
                        </div>
                        {{-- SHIPPING SECTION --}}
                        
                        {{-- PAYMENT STATUS SECTION --}}
                        <div class="flex flex-col w-full px-2 space-y-4 md:px-8 ">
                            <h2 class="mb-2 text-xl font-semibold text-gray-700 dark:text-gray-400">Status Pembayaran</h2>
                            <div class="flex items-start justify-between w-full">
                                <div class="flex items-center justify-center space-x-2">
                                    <div class="w-8 h-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-6 h-6 text-blue-600 dark:text-blue-400 bi bi-credit-card" viewBox="0 0 16 16">
                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0V4zm0 2h16v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6zm1 3a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col items-center justify-start">
                                        <p class="text-lg font-semibold leading-6 text-gray-800 dark:text-gray-400">
                                            @if($transaction->order_status == 'Menunggu Pembayaran')
                                                <span class="text-sm font-normal text-white bg-yellow-500 px-2 py-1 rounded">Menunggu Pembayaran</span>
                                            @elseif($transaction->order_status == 'Menunggu Pengambilan')
                                                <span class="text-sm font-normal text-white bg-green-500 px-2 py-1 rounded">Pembayaran Berhasil</span>
                                            @else
                                                <span class="text-sm font-normal text-white bg-red-500 px-2 py-1 rounded">{{ $transaction->order_status }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-start gap-4 px-4 mt-6 ">
                    <a href="/products" class="w-full text-center px-4 py-2 text-blue-500 border border-blue-500 rounded-md md:w-auto hover:text-white hover:bg-blue-600 dark:border-gray-700 dark:hover:bg-gray-700 dark:text-gray-300">
                        Go back shopping
                    </a>
                    <a href="/orders" class="w-full text-center px-4 py-2 bg-blue-500 rounded-md text-gray-50 md:w-auto dark:text-gray-300 hover:bg-blue-600 dark:hover:bg-gray-700 dark:bg-gray-800">
                        Lihat Order Lainnya
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

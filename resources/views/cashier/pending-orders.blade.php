<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir | Pesanan Pending</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    {{-- DATATABLES --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

</head>
<body class="font-Inter relative">
    @include("cashier.components.sidebar")
    <main class="p-10 font-Inter bg-plat min-h-[100vh] h-full" id="mainContent">
        @include("cashier.components.navbar")

        @if (session('success'))
            <div class="absolute top-4 left-[42.5vw] bg-mainColor shadow-md w-[25vw] h-14 z-20 gap-2 items-center px-4 animate-notif opacity-0 justify-center rounded-md flex unselectable">
                <i class="text-white fa-solid fa-circle-check"></i>
                <p class="text-lg text-white font-semibold"> {{ __('Status Berhasil Diperbaharui') }} </p>
            </div>
        @endif
        @if (session('error'))
            <div class="absolute top-4 left-[42.5vw] bg-red-600 shadow-md w-[15vw] h-14 z-20 gap-2 items-center px-4 animate-notif opacity-0 justify-center rounded-md flex unselectable">
                <i class="text-white fa-solid fa-triangle-exclamation"></i>
                <p class="text-lg text-white font-semibold"> {{ __('Terjadi Kesalahan') }} </p>
            </div>
        @endif

        <div class="flex flex-col gap-8 mt-10">
            <p class="text-3xl font-bold">Pesanan Pending</p>

            <div class="bg-white rounded-lg p-4 shadow-md">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Invoice</th>
                            <th>Nama Pengambil</th>
                            <th>Metode Pembayaran</th>
                            <th>Infomasi Pembayaran</th>
                            <th>Keterangan</th>
                            <th>Detail Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1;  @endphp
                        @php $index = 1;  @endphp
                        @foreach ($pendingOrders as $pendingOrder)    
                        <tr>
                            <td>{{$i}}</td>
                            <td>
                                <span class="font-bold">{{$pendingOrder->invoice_code}}</span>
                            </td>
                            <td>{{ $pendingOrder->recipient_name }}</td>
                            <td>
								<span class="bg-blue-500 py-1 px-3 rounded text-white shadow uppercase">
                                    {{ $pendingOrder->recipient_payment == 'other_qris' ? 'qris' : $pendingOrder->recipient_payment }}
                                </span>
                            <td>
								<span class="bg-green-500 py-1 px-3 rounded text-white shadow">
									{{ $pendingOrder->payment_status }}
								</span>
							</td>
                            <td>
                                {{-- stored function?? --}}
                                @php
                                // Konversi order_date menjadi objek Carbon
                                    $orderDate = \Carbon\Carbon::parse($pendingOrder->order_date);
                                // Mendapatkan waktu sekarang dan order_date + 3 hari
                                    $now = now();
                                    $deadline = $orderDate->addDays(3);
                                    // @dd($now->diffAsCarbonInterval($deadline));
                            
                                // Menghitung selisih waktu dalam bentuk CarbonInterval
                                    $difference = $now->diffAsCarbonInterval($deadline);
                            
                                // Mengambil informasi selisih waktu dalam bentuk hari, jam, dan menit
                                    $days = max($difference->format('%d'), 0); // Menggunakan fungsi max untuk memastikan nilai minimal adalah 0
                                    $hours = $difference->format('%h');
                                    $minutes = $difference->format('%i');
                                @endphp
                                @if($now->gt($deadline))
                                    <p>Masa Pengambilan Telah Lewat</p>
                                @else
                                    <p>Sisa {{ $days }} hari, {{ $hours }} jam, {{ $minutes }} menit</p>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-center w-full">
                                    <button class="border-2 border-secondaryColor rounded-md hover:bg-transparent hover:text-secondaryColor font-bold px-4 py-1 bg-secondaryColor text-white duration-300 transition-colors ease-in-out" 
                                    type="button" onclick="toggleDetail({{ $index }})" data-index="{{ $index }}">Lihat</button>
                                </div>

                                {{-- MODAL DETAIL PESANAN PENDING START --}}
                                <div class="absolute w-full h-screen top-0 left-0 flex justify-center items-center backdrop-brightness-75 z-10 hidden" id="detailModal{{ $index }}">
                                    <div class="w-[70%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-6 overflow-auto">
                                        <div class="">
                                            <button onclick="toggleDetail({{ $index }})" type="button" class="bg-mainColor py-1 px-4 text-white font-semibold rounded-md">
                                                <i class="fa-solid fa-arrow-left"></i>
                                                Kembali
                                            </button>
                                        </div>
    
                                        <div class="px-8 py-2 w-[100%] flex justify-between">
                                            <div class="overflow-y-auto h-72 w-[70%]">
                                                <table class="w-full h-fit overflow-scroll">
                                                    <tr class="border-2 border-b-mainColor border-transparent text-mainColor font-bold w-[100%]">
                                                        <td class="pb-2 text-center">No</td>
                                                        <td class="pb-2">Nama</td>
                                                        <td class="pb-2">Resep Dokter</td>
                                                        <td class="pb-2">Harga</td>
                                                        <td class="pb-2">Jumlah</td>
                                                        <td class="pb-2">Total</td>
                                                    </tr>
                                                    @php $j = 1; @endphp
                                                    @foreach($pendingOrder->sellingInvoiceDetail as $detail)
                                                    <tr>
                                                        <td class="py-2 text-center">{{ $j }}</td>
                                                        <td class="py-2">{{ $detail->product_name }}</td>
                                                        <td class="py-2">{{ $detail->product_type }}</td>
                                                        <td class="py-2">Rp {{ number_format($detail->product->product_sell_price, '0', ',', '.') }}</td>
                                                        <td class="py-2">{{ $detail->quantity }}</td>
                                                        <td class="py-2">Rp {{ number_format($detail->getTotalPrice(), '0', ',', '.') }}</td>
                                                    </tr>
                                                    @php $j++ @endphp
                                                    @endforeach
                                                </table>
                                            </div>
    
                                            <div class="w-[25%]">
                                                <table class="w-full">
                                                    <tr class="border-2 border-b-mainColor border-transparent text-mainColor font-bold w-[100%]">
                                                        <td class="pb-2">File Resep Dokter</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 flex gap-2 items-center">
                                                            <i class="fa-solid fa-image"></i>
                                                            <a href="/cashier/resep_dokter/{{ $pendingOrder->recipient_file }}" target="_blank">{{ $pendingOrder->recipient_file }}</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
										
										<div class="px-8 w-[100%]">
                                            <p class="text-mainColor font-bold py-2 border-2 border-b-mainColor border-transparent">Total Keseluruhan</p>
                                            <p class="py-4 font-bold">Rp {{ number_format($pendingOrder->getTotalInvoicePrice(), 0, ',', '.') }}</p>
                                        </div>

                                        <div class="flex justify-end w-full">
                                            @if($now->gt($deadline))
                                                <form action="{{ route('failOrder', $pendingOrder->id_selling_invoice) }}" method="get">
                                                    <button class="bg-red-600 text-white font-bold py-2 px-4 rounded-md shadow-md">Tandai Gagal</button>
                                                </form>
                                            @else
                                                <form action="{{ route('successOrder', $pendingOrder->id_selling_invoice) }}" method="get">
                                                    <button class="bg-green-600 text-white font-bold py-2 px-4 rounded-md shadow-md">Tandai Selesai</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- MODAL DETAIL PESANAN PENDING END --}}
                            </td>
                        </tr>
                        @php  $i++   @endphp
                        @php  $index++   @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>
        const toggleDetail = (index) => {
            const modal = document.getElementById('detailModal' + index);

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                document.body.classList.add('h-[100vh]');
            } else {
                modal.classList.add('hidden');
                document.body.classList.remove('h-[100vh]');
            }
        };
    </script>
</body>
</html>
{{-- CART START --}}
<div class="w-[33%] bg-white py-10 px-6 flex flex-col gap-10 shadow-md fixed right-0">
    <div class="flex flex-col gap-3">
            <div class="flex justify-between">
                <p class="font-bold text-2xl">Detail Pesanan</p>
                <button type="button" onclick="cartAlert()" class="text-mainColor font-bold py-1 px-2">Hapus Semua</button>
            </div>
        <hr class="border border-1 border-mediumGrey opacity-20 ">

        {{-- KONDISI TIDAK ADA ITEM DI KERANJANG --}}
        @if ($cartItems->isEmpty())
        <div class="h-[57vh] w-full flex justify-center items-center flex-col text-center gap-2">
            <i class="text-6xl text-mainColor fa-solid fa-cart-shopping"></i>
            <p class="font-semibold text-2xl text-mainColor">Tidak ada item di keranjang.</p>
        </div>
        {{-- KONDISI ADA ITEM DI KERANJANG --}}
        @else
        <div class="w-full h-[57vh] overflow-y-scroll flex flex-col gap-4" id="cartProduct">
            @php
                $jumlah = 0
            @endphp
            @foreach ($cartItems as $item)
            <div class="flex gap-2 mt-4">
                <div class="h-full flex items-center">
                    <img src="{{ asset('img/obat1.jpg')}}"
                    class="w-24 rounded-md" alt="">
                </div>

                <div class="flex flex-col justify-between w-80">
                        <p class="w-full font-semibold text-base namaObat leading-tight break-words">{{
                        $item->product->product_name }}</p>
                        @if ($item->product->description->product_type == "resep dokter")
                        <p class="bg-red-600 h-7 text-white w-fit px-2 py-1 text-sm rounded-md font-semibold">Resep</p>
                        @endif
                    <div class="flex justify-between">
                        <div class="w-[50%] text-secondaryColor font-bold break-all leading-tight">
                            Rp. {{
                            number_format($item->product->product_sell_price,
                            0,
                            ',', '.') }} <span class="text-black"> /
                            </span>
                            <p class="text-black"> {{ $item->product->description->unit->unit }}</p>
                        </div>
                        {{-- JUMLAH START --}}
                        <div class="w-[50%] flex justify-end">
                            <div class="w-fit border-1 border-semiBlack border rounded-md flex gap-4 px-2 ">
                                {{-- <livewire:cart-counter :cart="$item->cart_id"
                                    :stock="$item->product->detail()->orderBy('product_expired')->first()->product_stock"
                                    :quantity="$item->quantity" /> --}}

                                    @if ($item->quantity > 0)
                                        <button wire:click="decrementButton({{ $item }}, {{ $item->product->detail()->orderBy('product_expired')->first() }})">
                                            <i class="text-mainColor fa-solid fa-minus"></i>
                                        </button>
                                    @else
                                        <button wire:click="decrementButton" disabled>
                                            <i class="text-mediumGrey fa-solid fa-minus"></i>
                                        </button>
                                    @endif

                                        <input type="number" min="1" class="font-semibold w-8 text-center" value="{{ $item->quantity }}" readonly>
                                    @if ($item->quantity >= $item->product->detail->sum('product_stock'))
                                        <button wire:click="incrementButton" disabled>
                                            <i class="text-mediumGrey fa-solid fa-plus"></i>
                                        </button>
                                    @else
                                        <button wire:click="incrementButton({{ $item }}, {{ $item->product->detail()->sum('product_stock') }})">
                                            <i class="text-mainColor fa-solid fa-plus"></i>
                                        </button>
                                    @endif
                            </div>
                        </div>
                        {{-- JUMLAH END --}}
                    </div>
                </div>
            </div>
            @php
                $jumlah += $item->product->product_sell_price * $item->quantity
            @endphp
            @endforeach
        </div>
        @endif
    </div>

    {{-- TOTAL START --}}
    <div class="flex flex-col gap-4">
        <p class="font-bold text-2xl">Total Pesanan</p>
        <hr class="border border-1 border-mediumGrey opacity-20">

        <div class="">
            <div class="flex justify-between text-lg">
                <p class="font-bold text-mediumGrey">Total Barang</p>
                <p class="font-bold ">{{ $cartItems->count() }} Barang</p>
            </div>

            <div class="flex justify-between text-lg">
                <p class="font-bold text-mediumGrey">Total Harga</p>
                <p class="font-bold text-secondaryColor">Rp. {{ number_format($jumlah ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>

        <a href="{{ route('bayar_offline') }}" class="w-full py-2 bg-mainColor text-white font-bold text-lg rounded-md text-center">Bayar</a>
    </div>
    {{-- TOTAL END --}}
    
</div>
{{-- CART END --}}

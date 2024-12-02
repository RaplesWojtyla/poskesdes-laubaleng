<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="container mx-auto px-4">
    <h1 class="text-2xl font-semibold mb-4">Keranjang Belanja</h1>
    <div class="flex flex-col md:flex-row gap-4">
      <div class="md:w-3/4">
        <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
          <table class="w-full">
            <thead>
              <tr>
                <th class="text-left font-semibold">Nama Obat</th>
                <th class="text-left font-semibold">Harga</th>
                <th class="text-left font-semibold">Kuantitas</th>
                <th class="text-left font-semibold">Total</th>
                <th class="text-left font-semibold">Hapus</th>
              </tr>
            </thead>
            <tbody>
              @forelse($cartItems as $cartItem)
              <tr wire:key="{{ $cartItem->id_product }}">
                <td class="py-4">
                  <div class="flex items-center">
                    <img class="h-16 w-16 mr-4" src="{{ url('storage', $cartItem->product->productDescription->product_img) }}" alt="Product image">
                    <span class="font-semibold">{{ $cartItem->product->product_name }}</span>
                  </div>
                </td>
                <td class="py-4">Rp {{ number_format($cartItem->product->product_sell_price, '2', ',', '.') }}</td>
                <td class="py-4">
                  <div class="flex items-center">
                    <button wire:click="decreaseQuantity('{{ $cartItem->id_product }}')" class="border rounded-md py-2 px-4 mr-2">-</button>
                    <span class="text-center w-8">{{ $cartItem->quantity }}</span>
                    <button wire:click="increaseQuantity('{{ $cartItem->id_product }}')" class="border rounded-md py-2 px-4 ml-2">+</button>
                  </div>
                </td>
                <td class="py-4">Rp {{ number_format($cartItem->product->product_sell_price * $cartItem->quantity, '2', ',', '.') }}</td>
                <td>
                  <button wire:click="removeItem('{{ $cartItem->product->id_product }}')" class="bg-slate-300 border-2 border-slate-400 rounded-lg px-3 py-1 hover:bg-red-500 hover:text-white hover:border-red-700">
                    <span wire:loading.remove wire:target="removeItem('{{ $cartItem->product->id_product }}')">Hapus</span> <span wire:loading wire:target="removeItem('{{ $cartItem->product->id_product }}')">Menghapus...</span>
                  </button>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="5" class="text-center pt-10 pb-4 text-4xl font-semibold text-red-500">Keranjang Anda Kosong!</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="md:w-1/4">
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-lg font-semibold mb-4">Total Biaya</h2>
          <div class="flex justify-between mb-2">
            <span>Subtotal</span>
            <span>Rp {{ number_format($totalPrice, '2', ',', '.') }}</span>
          </div>
          <div class="flex justify-between mb-2">
            <span>Pengiriman</span>
            <span>Rp 0,00</span>
          </div>
          <hr class="my-2">
          <div class="flex justify-between mb-2">
            <span class="font-semibold">Total</span>
            <span class="font-semibold">Rp {{ number_format($totalPrice, '2', ',', '.') }}</span>
          </div>
          @if ($cartItems->isNotEmpty())
          <a href="/checkout" class="block text-center bg-blue-500 text-white py-2 px-4 rounded-lg mt-8 w-full">Checkout</a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
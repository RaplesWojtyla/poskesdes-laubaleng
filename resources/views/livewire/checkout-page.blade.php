<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
	<h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
		Checkout
	</h1>
	<form wire:submit.prevent="booking">
		<div class="grid grid-cols-12 gap-4">
			<div class="md:col-span-12 lg:col-span-8 col-span-12">
				<!-- Card -->
				<div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
					<!-- Informasi Penerima -->
					<div class="mb-6">
						<h2 class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
							Informasi Penerima		
						</h2>
						<div class="mt-4">
							<div>
								<label class="block text-gray-700 dark:text-white mb-1" for="recipientName">
									Nama Penerima
								</label>
								<input class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none @error('recipientName') border-red-500 @enderror" id="recipientName" wire:model="recipientName" type="text">
								</input>
								@error('recipientName')
								<div class="text-red-500 text-sm">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<div class="mt-4">
							<label class="block text-gray-700 dark:text-white mb-1" for="phone">
								Nomor Telepon
							</label>
							<input class="@error('phone') border-red-500 @enderror w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none" id="phone" wire:model="phone" type="text">
							</input>
							@error('phone')
								<div class="text-red-500 text-sm">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="text-lg underline font-semibold mb-4">
						Pilih Metode Pembayaran
					</div>
					<ul class="grid w-full gap-6 md:grid-cols-2">
						<li>
							<input wire:model="paymentMethod" class="hidden peer" id="hosting-small"  required="" type="radio" value="dana" />
							<label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-small">
								<div class="block">
									<div class="w-full text-lg font-semibold">
										Dana
									</div>
								</div>
								<svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none" viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
									</path>
								</svg>
							</label>
						</li>
						<li>
							<input wire:model="paymentMethod" class="hidden peer" id="hosting-big"  type="radio" value="gopay">
							<label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-big">
								<div class="block">
									<div class="w-full text-lg font-semibold">
										Gopay
									</div>
								</div>
								<svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none" viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
									</path>
								</svg>
							</label>
							</input>
						</li>
						<li>
							<input wire:model="paymentMethod" class="hidden peer" id="hosting-bank-transer" type="radio" value="other_qris">
							<label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-bank-transer">
								<div class="block">
									<div class="w-full text-lg font-semibold">
										QRIS
									</div>
								</div>
								<svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none" viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
									</path>
								</svg>
							</label>
						</li>
						<li>
							<input wire:model="paymentMethod" class="hidden peer" id="hosting-qris" type="radio" value="bank_transfer">
							<label class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700" for="hosting-qris">
								<div class="block">
									<div class="w-full text-lg font-semibold">
										Bank Transfer
									</div>
								</div>
								<svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none" viewbox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
									<path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
									</path>
								</svg>
							</label>
						</li>
					</ul>
					@error('paymentMethod')
						<div class="text-red-500 text-sm">{{ $message }}</div>
					@enderror

					@if($requiresPrescription)
					<div class="mt-6">
						<h2 class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
							Upload Resep Dokter
						</h2>
						<input type="file" wire:model="resepDokter" class="w-full rounded-lg border py-2 px-3 dark:bg-gray-700 dark:text-white dark:border-none">
						@error('resepDokter')
							<div class="text-red-500 text-sm">{{ $message }}</div>
						@enderror
					</div>
					@endif
				</div>
				<!-- End Card -->
			</div>
			<div class="md:col-span-12 lg:col-span-4 col-span-12">
				<div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
					<div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
						Order
					</div>
					<div class="flex justify-between mb-2 font-bold">
						<span>
							Subtotal
						</span>
						<span>
							Rp {{ number_format($totalPrice, '2', ',', '.') }}
						</span>
					</div>
					<div class="flex justify-between mb-2 font-bold">
					</div>
					<div class="flex justify-between mb-2 font-bold">
						<span>
							Biaya lainnya
						</span>
						<span>
							Rp 0.00
						</span>
					</div>
					<hr class="bg-slate-400 my-4 h-1 rounded">
					<div class="flex justify-between mb-2 font-bold">
						<span>
							Total
						</span>
						<span>
							Rp {{number_format($totalPrice, '2', ',', '.')}}
						</span>
					</div>
					</hr>
				</div>
				<button type="submit" class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
					Booking
				</button>
				<div class="bg-white mt-4 rounded-xl shadow p-4 sm:p-7 dark:bg-slate-900">
					<div class="text-xl font-bold underline text-gray-700 dark:text-white mb-2">
						Keranjang
					</div>
					<ul class="divide-y divide-gray-200 dark:divide-gray-700" role="list">
						@foreach ($cartItems as $cartItem)
						<li class="py-3 sm:py-4">
							<div class="flex items-center">
								<div class="flex-shrink-0">
									<img alt="{{ $cartItem->product->product_name }}" class="w-12 h-12 rounded-full" src="{{ url('storage', $cartItem->product->productDescription->product_img) }}">
									</img>
								</div>
								<div class="flex-1 min-w-0 ms-4">
									<p class="text-sm font-medium text-gray-900 truncate dark:text-white">
										{{ $cartItem->product->product_name }}
									</p>
									<p class="text-sm text-gray-500 truncate dark:text-gray-400">
										{{ $cartItem->quantity }}
									</p>
								</div>
								<div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
									Rp {{ number_format($cartItem->product->product_sell_price * $cartItem->quantity,  '2', ',', '.') }}
								</div>
							</div>
						</li>
						@endforeach
					</ul>
				</div>
			</div>
		</div>
	</form>
</div>
<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <section class="py-10 bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
    <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
      <div class="flex flex-wrap mb-24 -mx-3">
        <div class="w-full pr-2 lg:w-1/4 lg:block">
          <div class="p-4 mb-5 bg-white border border-gray-200 dark:border-gray-900 dark:bg-gray-900">
            <h2 class="text-2xl font-bold dark:text-gray-400"> Categories</h2>
            {{-- json_encode($selected_categories) --}}
            <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
            <ul>
              <li class="mb-4" wire:key="semua">
                <label for="all" class="flex items-center dark:text-gray-400 ">
                  <input id="all" type="radio" wire:model.live="selected_categories" class="w-4 h-4 mr-2" value="">
                  <span class="text-lg">All</span>
                </label>
              </li>
              @foreach ($categories as $category)
              <li class="mb-4" wire:key="{{ $category->id_category }}">
                <label for="{{ $category->category }}" class="flex items-center dark:text-gray-400 ">
                  <input id="{{ $category->category }}" type="radio" wire:model.live="selected_categories" class="w-4 h-4 mr-2" value="{{ $category->id_category }}">
                  <span class="text-lg">{{ $category->category }}</span>
                </label>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
            <h2 class="text-2xl font-bold dark:text-gray-400">Golongan Obat</h2>
            <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
            <ul>
              <li class="mb-4">
                <label for="semua" class="flex items-center dark:text-gray-400 ">
                  <input id="semua" type="radio" wire:model.live="golonganObat" class="w-4 h-4 mr-2" value="">
                  <span class="text-lg">Semua</span>
                </label>
              </li>
              <li class="mb-4">
                <label for="bebas" class="flex items-center dark:text-gray-400 ">
                  <input id="bebas" type="radio" wire:model.live="golonganObat" class="w-4 h-4 mr-2" value="Bebas">
                  <span class="text-lg">Bebas</span>
                </label>
              </li>
              <li class="mb-4">
                <label for="bebasTerbatas" class="flex items-center dark:text-gray-400 ">
                  <input id="bebasTerbatas" type="radio" wire:model.live="golonganObat" class="w-4 h-4 mr-2" value="Bebas Terbatas">
                  <span class="text-lg">Bebas Terbatas</span>
                </label>
              </li>
              <li class="mb-4">
                <label for="keras" class="flex items-center dark:text-gray-400 ">
                  <input id="keras" type="radio" wire:model.live="golonganObat" class="w-4 h-4 mr-2" value="Keras">
                  <span class="text-lg">Keras</span>
                </label>
              </li>
              <li class="mb-4">
                <label for="narkotika" class="flex items-center dark:text-gray-400 ">
                  <input id="narkotika" type="radio" wire:model.live="golonganObat" class="w-4 h-4 mr-2" value="Narkotika">
                  <span class="text-lg">Narkotika</span>
                </label>
              </li>
            </ul>
          </div>

          <div class="p-4 mb-5 bg-white border border-gray-200 dark:bg-gray-900 dark:border-gray-900">
            <h2 class="text-2xl font-bold dark:text-gray-400">Price</h2>
            <div class="w-16 pb-2 mb-6 border-b border-rose-600 dark:border-gray-400"></div>
            <div>
              <div class="font-semibold">Rp {{ number_format($price_range, '2', ',', '.') }}</div>
              <input type="range" class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer" wire:model.live="price_range" max="200000" value="20000" step="1000">
              <div class="flex justify-between ">
                <span class="inline-block text-lg font-bold text-blue-400 ">Rp {{ number_format(0, '2', ',', '.') }}</span>
                <span class="inline-block text-lg font-bold text-blue-400 ">Rp {{ number_format(200000, '2', ',', '.') }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="w-full px-3 lg:w-3/4">
          <div class="px-3 mb-4">
            <div class="items-center justify-between hidden px-3 py-2 bg-gray-100 md:flex dark:bg-gray-900 ">
              <div class="flex items-center justify-between">
                <input type="text" wire:model.live="search" placeholder="Search products..." class="block w-full text-base bg-gray-100 cursor-pointer dark:text-gray-400 dark:bg-gray-900">
                <select wire:model.live="sort" class="block w-40 text-base bg-gray-100 cursor-pointer dark:text-gray-400 dark:bg-gray-900">
                  <option value="latest">Sort by latest</option>
                  <option value="price">Sort by Price</option>
                </select>
              </div>
            </div>
          </div>
          <div class="flex flex-wrap items-center ">

            @foreach ($products as $product)
            <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3" wire:key="{{ $product->id_product }}">
              <div class="border border-gray-300 dark:border-gray-700">
                <div class="relative bg-gray-200">
                  <a wire:navigate href="/products/{{ $product->id_product }}" class="">
                    <img src="{{ url('storage', $product->productDescription->product_img) }}" alt="{{ $product->product_name }}" class="object-cover w-full h-56 mx-auto ">
                  </a>
                </div>
                <div class="p-3 ">
                  <div class="flex items-center justify-between gap-2 mb-2">
                    <h3 class="text-xl font-medium dark:text-gray-400">
                      {{ $product->product_name}}
                    </h3>
                  </div>
                  <p class="text-lg mb-2">
                    @if($product->productDescription->type == 'Umum')
                      <span class="bg-green-500 py-1 px-2 text-white rounded shadow"> Umum </span>
                    @else
                      <span class="bg-red-500 py-1 px-2 text-white rounded shadow"> Resep Dokter </span>
                    @endif
                  </p>
                  <p class="text-lg">
                    <span class="text-green-600 dark:text-green-600"> Rp {{ number_format($product->product_sell_price, '2', ',', '.')}}</span>
                  </p>
                </div>
                <div class="flex justify-center p-4 border-t border-gray-300 dark:border-gray-700">
                  @auth
                  <a wire:click.prevent="addToCart('{{ $product->id_product }}')" href="#" class="text-gray-500 flex items-center space-x-2 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-cart3 " viewBox="0 0 16 16">
                      <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                    </svg><span wire:loading.remove wire:target="addToCart('{{ $product->id_product }}')">Add to Cart</span> <span wire:loading wire:target="addToCart('{{ $product->id_product }}')">Adding...</span>
                  </a>
                  @else
                  <a href="{{ route('login') }}" class="text-gray-500 flex items-center space-x-2 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-300">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-4 h-4 bi bi-cart3 " viewBox="0 0 16 16">
                      <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"></path>
                    </svg>
                    <span>Login to Add to Cart</span>
                  </a>
                  @endauth
                </div>
              </div>
            </div>
            @endforeach

          </div>
          <!-- pagination start -->
          <div class="flex justify-end mt-6">
            {{ $products->links() }}
          </div>
          <!-- pagination end -->
        </div>
      </div>
    </div>
  </section>

</div>
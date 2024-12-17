<div>
    <div class="w-full h-screen bg-gradient-to-r from-blue-200 to-cyan-200 py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Grid -->
            <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
                <div>
                    <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white">Pesan Obat dengan Mudah, Cepat, dan <span class="text-blue-600">Terpercaya</span></h1>
                    <p class="mt-3 text-lg text-gray-800 dark:text-gray-400">Poskesdes Lau Baleng kini hadir secara online untuk memudahkan pemesanan obat-obatan. Dapatkan obat yang Anda butuhkan dengan sekali klik, tanpa antre panjang.</p>

                    <!-- Buttons -->
                    <div class="mt-7 grid gap-3 w-full sm:inline-flex">
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/register">
                            Get started
                            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6" />
                            </svg>
                        </a>
                    </div>
                    <!-- End Buttons -->
                </div>
                <!-- End Col -->

                <div class="relative ms-4">
                    <img class="w-full rounded-md" src="https://medicastore.com/themes/blue/images/placeholder/faskes_klini.webp" alt="Image Description">
                    <div class="absolute inset-0 -z-[1] bg-gradient-to-tr from-gray-200 via-white/0 to-white/0 w-full h-full rounded-md mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-slate-800 dark:via-slate-900/0 dark:to-slate-900/0"></div>

                    <!-- SVG-->
                    <div class="absolute bottom-0 start-0">
                        <svg class="w-2/3 ms-auto h-auto text-white dark:text-slate-900" width="630" height="451" viewBox="0 0 630 451" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="531" y="352" width="99" height="99" fill="currentColor" />
                            <rect x="140" y="352" width="106" height="99" fill="currentColor" />
                            <rect x="482" y="402" width="64" height="49" fill="currentColor" />
                            <rect x="433" y="402" width="63" height="49" fill="currentColor" />
                            <rect x="384" y="352" width="49" height="50" fill="currentColor" />
                            <rect x="531" y="328" width="50" height="50" fill="currentColor" />
                            <rect x="99" y="303" width="49" height="58" fill="currentColor" />
                            <rect x="99" y="352" width="49" height="50" fill="currentColor" />
                            <rect x="99" y="392" width="49" height="59" fill="currentColor" />
                            <rect x="44" y="402" width="66" height="49" fill="currentColor" />
                            <rect x="234" y="402" width="62" height="49" fill="currentColor" />
                            <rect x="334" y="303" width="50" height="49" fill="currentColor" />
                            <rect x="581" width="49" height="49" fill="currentColor" />
                            <rect x="581" width="49" height="64" fill="currentColor" />
                            <rect x="482" y="123" width="49" height="49" fill="currentColor" />
                            <rect x="507" y="124" width="49" height="24" fill="currentColor" />
                            <rect x="531" y="49" width="99" height="99" fill="currentColor" />
                        </svg>
                    </div>
                    <!-- End SVG-->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Grid -->
        </div>
    </div>

    {{-- Category Start --}}
    <div class="bg-orange-200 py-20">
        <div class="max-w-xl mx-auto">
            <div class="text-center ">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-5xl font-bold dark:text-gray-200"> Browse <span class="text-blue-500"> Categories
                        </span> </h1>
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200">
                        </div>
                        <div class="flex-1 h-2 bg-blue-400">
                        </div>
                        <div class="flex-1 h-2 bg-blue-600">
                        </div>
                    </div>
                </div>
                <p class="mb-12 text-base text-center text-gray-500">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus magni eius eaque?
                    Pariatur
                    numquam, odio quod nobis ipsum ex cupiditate?
                </p>
            </div>
        </div>

        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">

                @foreach ($categories as $category)
                <a wire:key="{{ $category->id_category }}" class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="/products?selected_categories[0]={{ $category->id_category }}">
                    <div class="p-4 md:p-5">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img class="h-[2.375rem] w-[2.375rem] rounded-full" src="{{ url('storage', $category->category_img) }}" alt="{{ $category->category }}">
                                <div class="ms-3">
                                    <h3 class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                                        {{ $category->category }}
                                    </h3>
                                </div>
                            </div>
                            <div class="ps-3">
                                <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach

            </div>
        </div>

    </div>
    {{-- Category End --}}

</div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir | Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    <style>
        body::-webkit-scrollbar {
            display: none
        }
        /* width */
        #cartProduct::-webkit-scrollbar {
            width: 10px;
        }
        
        /* Track */
        #cartProduct::-webkit-scrollbar-track {
            background: transparent;
            border-radius: 5px;
        }
        
        /* Handle */
        #cartProduct::-webkit-scrollbar-thumb {
            background: #1A8889;
            border-radius: 5px;
        }
        
        /* Handle on hover */
        #cartProduct::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

    @livewireStyles
</head>

<body class="font-Inter relative">

    @include('cashier.components.sidebar')

    <main class="flex flex-grow bg-plat min-h-[100vh]" id="mainContent">
        @if (session('success'))
            <div class="absolute top-4 left-[42.5vw] bg-mainColor shadow-md w-[15vw] h-14 z-20 gap-2 items-center px-4 animate-notif opacity-0 justify-center rounded-md flex unselectable">
                <i class="text-white fa-solid fa-circle-check"></i>
                <p class="text-lg text-white font-semibold"> {{ __('Transaksi Berhasil') }} </p>
            </div>
        @endif
        @if (session('error'))
            <div class="absolute top-4 left-[42.5vw] bg-red-600 shadow-md w-[15vw] h-14 z-20 gap-2 items-center px-4 animate-notif opacity-0 justify-center rounded-md flex unselectable">
                <i class="text-white fa-solid fa-triangle-exclamation"></i>
                <p class="text-lg text-white font-semibold"> {{ __('Transaksi Gagal') }} </p>
            </div>
        @endif

        <livewire:cashier.show-products/>
        
        {{-- LIVE CART START --}}
        <livewire:cashier.live-cart/> 
        {{-- LIVE CART END --}}

        <form action="/cashier/hapuskeranjang" method="POST" class="w-screen h-screen opacity-0 absolute top-0 backdrop-blur-md z-50 hidden flex justify-center items-center transition duration-300 ease-in-out backdrop-brightness-50" id="cartAlertPopUp">
            @csrf
            <input type="hidden" name="hapus" value="semua">    
            <div class="bg-white h-fit w-[30%] rounded-lg shadow-sm shadow-semiBlack py-10 px-8 flex flex-col gap-4 items-center text-center">
                <i class="text-7xl text-mainColor fa-solid fa-circle-question"></i>
                <p class="text-2xl font-bold w-[80%]">Apakah Anda Yakin Ingin Menghapus Seluruh Data Keranjang ?</p>
                <button onclick="cartAlert()" type="button" class="bg-mainColor px-4 w-52 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack">Kembali</button>
                <button type="submit" class="bg-mediumRed w-52 px-4 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack" disabled id="cartLogout">Hapus</button>
            </div>
        </form>
    </main>
    @livewireScripts
    <script>
        const cartAlert = () => {
        const modal = document.getElementById('cartAlertPopUp');
        const button = document.getElementById("cartLogout");

        if (modal.classList.contains('hidden')) {
            button.disabled = false;
            requestAnimationFrame(() => {
                modal.classList.remove('hidden');
                document.body.classList.add('max-h-[100vh]', 'overflow-hidden');
                requestAnimationFrame(() => {
                    modal.classList.add('opacity-100');
                });
            });
        } else {
            button.disabled = true;
            requestAnimationFrame(() => {
                modal.classList.remove('opacity-100');
                document.body.classList.remove('max-h-[100vh]', 'overflow-hidden');
                requestAnimationFrame(() => {
                    modal.classList.add('hidden');
                });
            });
        }
    }
    </script>

    <script>
        const toggleSidebar = () => {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('mainContent');

            if (sidebar.classList.contains('-translate-x-96')) {
                sidebar.classList.remove('-translate-x-96')
                main.classList.add('brightness-50')
            } else {
                sidebar.classList.add('-translate-x-96')
                main.classList.remove('brightness-50')
            }

        }

        function initializeDropdown(buttonId, menuId) {
            const dropdownButton = document.getElementById(buttonId);
            const dropdownMenu = document.getElementById(menuId);
            let isDropdownOpen = true;

            function toggleDropdown() {
                isDropdownOpen = !isDropdownOpen;
                if (isDropdownOpen) {
                    dropdownMenu.classList.remove('hidden');
                } else {
                    dropdownMenu.classList.add('hidden');
                }
            }

            toggleDropdown();

            dropdownButton.addEventListener('click', toggleDropdown);

            window.addEventListener('click', (event) => {
                if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                    isDropdownOpen = false;
                }
            });
        }

        // samakan dengan jumlah filter
        for (let i = 0; i < 4; i++) {
            initializeDropdown('dropdown-button' + i, 'dropdown-menu' + i);
        }
    </script>
</body>

</html>
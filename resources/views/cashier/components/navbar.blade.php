<div class="flex justify-between">
    <div class="flex gap-8">
        <button onclick="toggleSidebar()" class="bg-white h-10 w-10 rounded-md shadow-md p-1">
            <i class="fa-solid fa-bars text-mediumGrey"></i>
        </button>

        <a href="/cashier" class="text-xl rounded-lg font-bold hover:bg-teal-700 duration-300 text-white bg-mainColor text-center px-4 py-2"><- Belanja Offline</a>
    </div>

    <a href="/cashier/pending-orders" class="@if($total > 0) animate-bounce duration-200 @endif flex gap-2 items-center text-mainColor bg-white shadow-md rounded-full px-2 py-1">
        <i class="fa-solid fa-circle-exclamation text-xl"></i>
        <p class="font-bold">{{ $total }} Pesanan Pending</p>
    </a>
</div>

<script>
    const toggleSidebar = () => {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('mainContent');

        if (sidebar.classList.contains('-translate-x-96')) {
            sidebar.classList.remove('-translate-x-96')
            main.classList.add('brightness-50')
            // document.body.classList.add('h-[100vh]')
            // document.body.classList.add('overflow-hidden')
        } else {
            sidebar.classList.add('-translate-x-96')
            main.classList.remove('brightness-50')
            // document.body.classList.remove('h-[100vh]')
            // document.body.classList.remove('overflow-hidden')
        }

    }
</script>
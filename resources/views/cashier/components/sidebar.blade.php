{{-- SIDEBAR START --}}
<nav class="bg-white p-8 w-[20%] shadow-md absolute left-0 top-0 h-[100%] z-10 shadow-semiBlack -translate-x-96 transition-transform duration-300 ease-in-out flex flex-col gap-4" id="sidebar">
    <div class="flex justify-between w-full">
        <p class="bg-mainColor text-white font-bold px-4 py-1 rounded-br-xl rounded-tl-xl text-lg">Lau Baleng</p>


        <button onclick="toggleSidebar()" class="text-xl text-black font-bold">
            &#10005;
        </button>
    </div>

    <hr class="border border-1 border-mediumGrey opacity-20">

    <div class="flex flex-col gap-4 py-4 font-bold text-lg text-mediumGrey">
        <a href="/cashier" class="hover:text-mainColor">
            <i class="mr-4 w-4 fa-solid fa-cart-plus"></i>
            Produk
        </a>
        <a href="/cashier/pending-orders" class="hover:text-mainColor">
            <i class="mr-4 w-4 fa-solid fa-spinner"></i>
            Pesanan Pending
        </a>
        <a href="/cashier/history-transaction" class="hover:text-mainColor">
            <i class="mr-4 w-4 fa-solid fa-clock-rotate-left"></i>
            Riwayat Transaksi
        </a>
        <div>
            <button onclick="logoutAlert()" type="button" class="hover:text-mainColor">
                <i class="mr-4 w-4 fa-solid fa-arrow-right-from-bracket"></i>
                Logout
            </button>
        </div>
    </div>
</nav>
{{-- SIDEBAR END --}}
{{-- LOGOUT ALERT START --}}
<form action="/logout" method="POST" class="w-screen h-screen opacity-0 absolute top-0 backdrop-blur-md z-50 hidden flex justify-center items-center transition duration-300 ease-in-out backdrop-brightness-50" id="logoutAlertPopUp">
    @csrf
    <div class="bg-white h-fit w-[30%] rounded-lg shadow-sm shadow-semiBlack py-10 px-8 flex flex-col gap-4 items-center text-center">
        <i class="text-7xl text-mainColor fa-solid fa-circle-question"></i>
        <p class="text-2xl font-bold w-[80%]">Apakah Anda yakin ingin keluar dari akun Anda?</p>
        <button onclick="logoutAlert()" type="button" class="bg-mainColor px-4 w-52 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack">Kembali</button>
        <button type="submit" class="bg-mediumRed w-52 px-4 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack" disabled id="btnLogout">Keluar</button>
    </div>
</form>  
{{-- LOGOUT ALERT END --}}

<script>
    const logoutAlert = () => {
        const modal = document.getElementById('logoutAlertPopUp');
        const button = document.getElementById("btnLogout");

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

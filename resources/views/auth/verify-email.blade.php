<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Poskesdes | Email Verification</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

</head>
<body class="font-Trip bg-gradient-to-br from-mainColor to-tertiaryColor h-[100vh] flex justify-center items-center">
        <div class="bg-white w-[35vw] h-[60vh] rounded-3xl shadow-xl flex flex-col justify-center items-center gap-6 px-16 py-4 text-center">
            <p class="font-TripBold text-4xl">Verifikasi Email</p>
            <p class="text-md">Cek Email yang Anda daftarkan untuk memverifikasi akun Anda.</p>

            @if (session('status') == 'verification-link-sent')
                <div class="text-sm text-mainColor mt-1 ms-3 mb-0 text-center">
                    {{ __('Link Verifikasi Baru Telah Dikirimkan, Silahkan Cek Email Yang Anda Daftarkan!') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button class="w-[250px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack bg-secondaryColor font-TripBold text-white flex justify-center items-center text-xl">Kirim Ulang Verifikasi</button>
            </form>

            <form method="GET" action="{{ route('customer.logout') }}">
                @csrf
                <button
                class="w-[171px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack bg-red-500 font-TripBold text-white flex justify-center items-center text-xl"
                type="submit">Logout</button>
            </form>
        </div>
</body>
</html>
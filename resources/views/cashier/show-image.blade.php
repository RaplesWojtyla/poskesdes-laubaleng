<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
</head>
<body class="font-Inter bg-black">
    <div class="h-screen w-screen object-fill flex justify-center">
        {{-- @dd($root.'/'.$file); --}}
        <embed src="{{ asset('storage/'. $root .'/' . $file) }}" class="w-full object-scale-down top-16 relative"></embed>
        <div class="absolute left-0 top-0 w-full h-20 bg-gradient-to-b from-black to-transparent opacity-60"></div>
        <p class="absolute left-5 top-5 text-white font-bold drop-shadow-md">{{ $file }}</p>
    </div>
</body>
</html>
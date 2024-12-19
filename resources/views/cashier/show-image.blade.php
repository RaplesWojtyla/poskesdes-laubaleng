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
	<div class="min-h-screen w-screen flex justify-center items-center bg-gray-900">
		<div class="relative">
			<img src="{{ url('storage', $file) }}" class="max-w-full max-h-screen object-contain shadow-lg rounded-lg border-4 border-gray-700" />
			<div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-70 rounded-lg"></div>
		</div>
	</div>
</body>
</html>
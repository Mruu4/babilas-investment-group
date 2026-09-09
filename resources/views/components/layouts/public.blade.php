<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Babilas Investment Group Ltd' }}</title>
    <meta name="description" content="{{ $description ?? 'Babilas Investment Group Ltd — A diversified investment group operating across Real Estate, Agriculture, Technology, Automobiles, and Stocks. Invest • Grow • Prosper.' }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white" x-data>

    <x-layouts.public-header />

    <main class="pt-20">
        {{ $slot }}
    </main>

    <x-layouts.public-footer />

</body>
</html>

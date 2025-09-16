<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-50 dark:bg-gray-300">
    
    {{-- Navbar --}}
    <x-navbar ></x-navbar>

    {{-- Main Content --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

</body>
</html>

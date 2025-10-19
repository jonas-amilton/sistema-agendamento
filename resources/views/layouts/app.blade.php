<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Mary Help') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-900 text-gray-100 font-sans min-h-screen flex flex-col">
    <header class="flex justify-between items-center p-4 bg-gray-800 shadow">
        <div class="text-2xl font-bold text-yellow-400">{{ config('app.name', 'Mary Help') }}</div>
        <nav>
            <a href="{{ route('patient.login') }}"
                class="bg-yellow-400 text-gray-900 px-4 py-2 rounded font-semibold hover:bg-yellow-500 transition">Login</a>
        </nav>
    </header>

    <main class="flex-grow container mx-auto p-4">
        @yield('content')
    </main>

    <footer class="p-4 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} Mary Help
    </footer>
</body>

</html>

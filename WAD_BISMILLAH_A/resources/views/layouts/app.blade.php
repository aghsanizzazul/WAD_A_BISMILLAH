<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    {{-- Navbar --}}
    <nav class="bg-white shadow p-4 mb-6">
        <div class="container mx-auto flex justify-between">
            <div class="font-bold text-lg">GYM Admin</div>
            <div>
                <a href="/dzulfikar-dashboard" class="text-blue-500 mr-4">Dashboard</a>
                <a href="/dzulfikar-input" class="text-blue-500">Input Pembayaran</a>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main class="container mx-auto">
        @yield('content')
    </main>
</body>
</html>

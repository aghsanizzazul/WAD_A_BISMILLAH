<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYM Admin</title>
    <!-- Replace Vite with Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        a{
            padding: 10px;

        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Navigation -->
    <nav class="bg-white shadow p-4 mb-6">
        <div class="container mx-auto flex justify-between">
            <div class="font-bold text-lg">GYM Admin</div>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-blue-500 mr-4">Dashboard</a>
                <a href="{{ route('members.index') }}" class="text-blue-500 mr-4">Members</a>
                <a href="{{ route('pembayaran.index') }}" class="text-blue-500 mr-4">Payments</a>
                <a href="{{ route('langganan.index') }}" class="text-blue-500 mr-4">Subscriptions</a>
                <a href="{{ route('classes.index') }}" class="text-blue-500">Classes</a>
                <a href="{{ route('pelatih.index') }}" class="text-blue-500">Trainers</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="container mx-auto">
        @yield('content')
    </main>
</body>
</html>

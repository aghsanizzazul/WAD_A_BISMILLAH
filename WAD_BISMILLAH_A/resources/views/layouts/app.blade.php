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
        <div class="container mx-auto flex justify-between items-center">
            <div class="font-bold text-lg">GYM Admin</div>
            @auth
                <div class="flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-500 mr-4">Dashboard</a>
                    <a href="{{ route('members.index') }}" class="text-blue-500 mr-4">Members</a>
                    <a href="{{ route('pembayaran.index') }}" class="text-blue-500 mr-4">Payments</a>
                    <a href="{{ route('langganan.index') }}" class="text-blue-500 mr-4">Subscriptions</a>
                    <a href="{{ route('classes.index') }}" class="text-blue-500 mr-4">Classes</a>
                    <a href="{{ route('pelatih.index') }}" class="text-blue-500 mr-4">Trainers</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <div>
                    <a href="{{ route('login') }}" class="text-blue-500 mr-4">Login</a>
                    <a href="{{ route('register') }}" class="text-blue-500">Register</a>
                </div>
            @endauth
        </div>
    </nav>

    <!-- Content -->
    <main class="container mx-auto">
        @yield('content')
    </main>
</body>
</html>

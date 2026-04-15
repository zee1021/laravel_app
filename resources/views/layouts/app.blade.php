<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TradeLoop</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <!-- NAVBAR -->
    <nav class="bg-white shadow p-4 flex justify-between">
        <h1 class="text-xl font-bold text-blue-600">TradeLoop</h1>

        <div class="space-x-4">
            <a href="/" class="text-gray-600 hover:text-blue-500">Home</a>

            @auth
                <a href="/dashboard" class="text-gray-600">Dashboard</a>
                <a href="/profile" class="text-gray-600">Profile</a>
            @else
                <a href="/login" class="text-gray-600">Login</a>
                <a href="/register" class="text-gray-600">Register</a>
            @endauth
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="p-6">
        {{ $slot }}
    </main>

</body>
</html>

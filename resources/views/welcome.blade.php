<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel with Tailwind</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-blue-500">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">
                Tailwind is Working!
            </h1>
            <p class="text-lg text-gray-600">
                Models and Migrations are ready, and the frontend is now styled.
            </p>
            <button class="mt-6 px-6 py-2 bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition">
                Success
            </button>
        </div>
    </div>
</body>
</html>
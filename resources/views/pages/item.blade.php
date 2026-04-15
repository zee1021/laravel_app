<x-app-layout>

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

    <img src="{{ asset('storage/' . $item->image) }}"
         class="w-full h-80 object-cover rounded mb-4">

    <h1 class="text-2xl font-bold">{{ $item->title }}</h1>

    <p class="text-gray-600">{{ $item->location }}</p>

    <p class="text-xl text-blue-600 font-bold mt-2">
        ₱{{ number_format($item->price, 2) }}
    </p>

    <p class="mt-4 text-gray-700">
        {{ $item->description }}
    </p>

    @auth
        <div class="mt-6 p-4 bg-gray-100 rounded">
            <p><strong>Seller:</strong> {{ $item->user->name }}</p>
            <p><strong>Email:</strong> {{ $item->user->email }}</p>
        </div>
    @endauth

</div>

</x-app-layout>
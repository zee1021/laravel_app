<div class="bg-white rounded-lg shadow hover:shadow-lg transition">

    <img src="{{ asset('storage/' . $item->image) }}"
         class="w-full h-48 object-cover rounded-t-lg">

    <div class="p-4">
        <h2 class="text-lg font-semibold">{{ $item->title }}</h2>

        <p class="text-gray-500 text-sm">{{ $item->location }}</p>

        <p class="text-blue-600 font-bold mt-2">
            ₱{{ number_format($item->price, 2) }}
        </p>

        <a href="/item/{{ $item->id }}"
           class="block mt-3 text-center bg-blue-500 text-white py-2 rounded hover:bg-blue-600">
           View Details
        </a>
    </div>

</div>
<x-app-layout>

    <!-- FILTER -->
    <div class="mb-6 flex gap-3">
        <a href="/" class="px-4 py-2 bg-blue-500 text-white rounded">All</a>
        <a href="/?category=Cars" class="px-4 py-2 bg-gray-200 rounded">Cars</a>
        <a href="/?category=Computers" class="px-4 py-2 bg-gray-200 rounded">Computers</a>
        <a href="/?category=Clothes" class="px-4 py-2 bg-gray-200 rounded">Clothes</a>
    </div>

    <!-- GRID -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        @foreach($items as $item)
            <x-item-card :item="$item" />
        @endforeach

    </div>

</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Latest Listings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if($items->count())
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($items as $item)
                                <a href="{{ route('items.show', $item) }}" class="block border border-gray-100 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300 bg-gray-50">
                                    <div class="w-full h-48 bg-gray-200">
                                        @if($item->images->count() > 0)
                                            <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="flex items-center justify-center h-full text-gray-400 text-xs">No Image</div>
                                        @endif
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-bold text-lg truncate">{{ $item->title }}</h3>
                                        <p class="text-sm text-gray-500">{{ $item->category->name }}</p>
                                        <p class="font-extrabold text-xl text-gray-800 mt-2">₱{{ number_format($item->price, 2) }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        <div class="mt-8">
                            {{ $items->links() }}
                        </div>
                    @else
                        <div class="text-center py-16 text-gray-500">
                            <p>No items have been listed yet. Check back soon!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
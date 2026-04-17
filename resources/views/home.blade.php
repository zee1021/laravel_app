<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Marketplace') }}
        </h2>
    </x-slot>

    <!-- Hero Section -->
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl lg:text-6xl">
                <span class="block">Welcome to</span>
                <span class="block text-blue-600">TradeLoop</span>
            </h1>
            <p class="mt-4 max-w-lg mx-auto text-xl text-gray-500">
                The best place to buy and sell amazing pre-loved and new things.
            </p>
            <div class="mt-8 flex justify-center">
                <div class="inline-flex rounded-md shadow">
                    <a href="{{ route('seller.dashboard') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Sell an Item
                    </a>
                </div>
                <div class="ml-3 inline-flex">
                    <a href="#latest-listings" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200">
                        Explore Listings
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Categories Section -->
            @if(isset($categories) && $categories->count())
            <div class="mb-12">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Browse by Category</h2>
                <div class="mt-6 grid grid-cols-2 gap-y-6 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-x-4">
                    @foreach($categories as $category)
                        <a href="#" class="group text-center">
                            <div class="w-24 h-24 mx-auto rounded-full bg-white shadow-sm flex items-center justify-center group-hover:bg-blue-50 transition">
                                {{-- Placeholder for category icon --}}
                                <svg class="h-12 w-12 text-gray-400 group-hover:text-blue-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 7h.01M7 3h5a2 2 0 012 2v5a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2zm10 14h.01M17 13h5a2 2 0 012 2v5a2 2 0 01-2 2h-5a2 2 0 01-2-2v-5a2 2 0 012-2zM7 14h.01M7 13h5a2 2 0 012 2v5a2 2 0 01-2 2H7a2 2 0 01-2-2v-5a2 2 0 012-2zM17 7h.01M17 3h5a2 2 0 012 2v5a2 2 0 01-2 2h-5a2 2 0 01-2-2V5a2 2 0 012-2z"></path></svg>
                            </div>
                            <p class="mt-3 text-sm font-medium text-gray-900">{{ $category->name }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            <h2 id="latest-listings" class="text-2xl font-bold tracking-tight text-gray-900 mb-6">
                Latest Listings
            </h2>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    @if($items->count())
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($items as $item)
                                <a href="{{ route('items.show', $item) }}" class="block border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow duration-300 bg-white">
                                    <div class="w-full h-48 bg-gray-200">
                                        @if($item->images->count() > 0)
                                            <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="flex items-center justify-center h-full bg-gray-100 text-gray-400">
                                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
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
                            <svg class="mx-auto h-20 w-20 text-gray-300" fill="none" viewBox="0 0 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-800">No items listed yet</h3>
                            <p class="mt-1 text-sm text-gray-500">Why not be the first? Get started by listing your item.</p>
                            <div class="mt-6">
                                <a href="{{ route('seller.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <!-- Heroicon name: solid/plus -->
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Post a New Item
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
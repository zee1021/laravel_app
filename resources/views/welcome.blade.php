<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TradeLoop | Buy & Sell</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-900">

    @include('layouts.navigation')

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 text-white overflow-hidden">
        <div class="max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="text-4xl font-extrabold sm:text-5xl sm:tracking-tight lg:text-6xl drop-shadow-md">
                Find your next <span class="text-blue-200">treasure</span>.
            </h1>
            <p class="mt-5 max-w-xl mx-auto text-xl text-blue-100">
                The best marketplace for secondhand cars, computers, clothes, and more in Baguio City.
            </p>
            <div class="mt-8 flex justify-center gap-4">
                <a href="#explore" class="bg-white text-blue-700 font-bold px-8 py-3 rounded-full shadow-lg hover:bg-blue-50 hover:scale-105 transition-all duration-300">
                    Start Exploring
                </a>
            </div>
        </div>
    </div>

    <main id="explore" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <!-- Categories -->
        <div class="mb-12 flex flex-col items-center">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Explore Categories</h2>
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('home') }}" 
                   class="px-6 py-2.5 rounded-full font-medium shadow-sm transition-all duration-300 {{ !request('category') ? 'bg-blue-600 text-white shadow-blue-200 border-transparent scale-105' : 'bg-white text-gray-600 border border-gray-200 hover:border-blue-400 hover:text-blue-600 hover:shadow-md' }}">
                    All Items
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('home', ['category' => $category->id]) }}" 
                       class="px-6 py-2.5 rounded-full font-medium shadow-sm transition-all duration-300 {{ request('category') == $category->id ? 'bg-blue-600 text-white shadow-blue-200 border-transparent scale-105' : 'bg-white text-gray-600 border border-gray-200 hover:border-blue-400 hover:text-blue-600 hover:shadow-md' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Items Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($items as $item)
                <a href="{{ route('items.show', $item) }}" class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col">
                    <div class="relative w-full h-56 bg-gray-100 overflow-hidden">
                        @if($item->images->first())
                            <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                        
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-gray-800 shadow-sm border border-white/20">
                            {{ $item->condition ?? 'Used' }}
                        </div>
                    </div>

                    <div class="p-5 flex-1 flex flex-col">
                        <p class="text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">{{ $item->category->name }}</p>
                        <h3 class="text-lg font-bold text-gray-900 line-clamp-2 leading-tight group-hover:text-blue-600 transition-colors">{{ $item->title }}</h3>
                        
                        <p class="mt-auto pt-4 text-2xl font-black text-gray-900">₱{{ number_format($item->price, 0) }}</p>
                        
                        <div class="mt-3 flex items-center text-sm text-gray-500">
                            <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                            <span class="truncate">{{ $item->location ?? 'Not specified' }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9m-9-9l9 9"></path></svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No items found</h3>
                    <p class="mt-1 text-sm text-gray-500">Check back later or try a different category.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination Links -->
        <div class="mt-12">
            {{ $items->links() }}
        </div>
    </main>
</body>
</html>
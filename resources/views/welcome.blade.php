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

    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl sm:tracking-tight lg:text-6xl">
                Find your next <span class="text-blue-600">treasure</span>.
            </h1>
            <p class="mt-5 max-w-xl mx-auto text-xl text-gray-500">
                The best marketplace for secondhand cars, computers, clothes, and more in Camp 3.
            </p>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="mb-10">
            <h2 class="text-lg font-semibold mb-4 text-gray-700">Browse Categories</h2>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('home') }}" 
                   class="px-5 py-2 rounded-full border transition {{ !request('category') ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 hover:border-blue-400' }}">
                    All Items
                </a>
                @foreach($categories as $category)
                    <a href="{{ route('home', ['category' => $category->id]) }}" 
                       class="px-5 py-2 rounded-full border transition {{ request('category') == $category->id ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 hover:border-blue-400' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($items as $item)
                <div class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition duration-300">
                    <div class="h-48 bg-gray-200 overflow-hidden">
                        @if($item->images->first())
                            <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>

                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs font-bold text-blue-600 uppercase tracking-wider">{{ $item->category->name }}</p>
                                <h3 class="mt-1 text-lg font-bold text-gray-900 truncate">{{ $item->title }}</h3>
                            </div>
                        </div>
                        
                        <p class="mt-2 text-2xl font-black text-gray-900">₱{{ number_format($item->price, 2) }}</p>
                        
                        <div class="mt-4 flex items-center text-sm text-gray-500">
                            <svg class="flex-shrink-0 mr-1.5 h-4 w-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                            {{ $item->location }}
                        </div>

                        <a href="#" class="mt-5 block w-full text-center bg-gray-900 text-white py-2 rounded-lg font-semibold hover:bg-gray-800 transition">
                            View Details
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9
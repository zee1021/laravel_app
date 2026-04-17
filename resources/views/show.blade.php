<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $item->title }}
            </h2>
            <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Back to Listings</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex-col md:flex-row gap-8">
                    
                    <!-- Image Gallery -->
                    <div class="md:w-1/2">
                        @if($item->images->count() > 0)
                            <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" alt="{{ $item->title }}" class="w-full h-96 object-cover rounded-lg shadow-md mb-4">
                            <div class="grid grid-cols-4 gap-2">
                                @foreach($item->images->skip(1) as $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-24 object-cover rounded-md shadow-sm border border-gray-200">
                                @endforeach
                            </div>
                        @else
                            <div class="w-full h-96 bg-gray-100 rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-400">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="mt-2 text-sm">No images available</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Item Details -->
                    <div class="md:w-1/2">
                        <span class="inline-block px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-bold uppercase tracking-wider">{{ $item->category->name }}</span>
                        <h1 class="text-3xl font-black text-gray-900 mt-3 mb-4">{{ $item->title }}</h1>
                        <p class="text-4xl font-bold text-gray-900 mb-6">₱{{ number_format($item->price, 2) }}</p>

                        <div class="bg-gray-50 p-5 rounded-lg mb-6 border border-gray-100 space-y-3 text-sm">
                            <p><span class="font-semibold text-gray-700 inline-block w-24">Condition:</span> {{ $item->condition }}</p>
                            <p><span class="font-semibold text-gray-700 inline-block w-24">Location:</span> {{ $item->location ?? 'Not specified' }}</p>
                            <p><span class="font-semibold text-gray-700 inline-block w-24">Posted By:</span> {{ $item->user->name }}</p>
                            <p><span class="font-semibold text-gray-700 inline-block w-24">Date Listed:</span> {{ $item->created_at->format('F j, Y') }}</p>
                        </div>

                        <div class="mb-8 prose prose-sm text-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Description</h3>
                            <p class="whitespace-pre-wrap">{{ $item->description }}</p>
                        </div>

                        @auth
                            <a href="mailto:{{ $item->user->email }}?subject=Inquiry about your {{ $item->title }} listing" class="block w-full text-center bg-blue-600 text-white py-3 rounded-lg font-semibold shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition">Contact Seller via Email</a>
                        @else
                            <div class="block w-full text-center bg-gray-100 border border-gray-300 text-gray-600 py-3 rounded-lg shadow-sm">
                                <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-500 transition">Log in</a> to view seller contact details
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
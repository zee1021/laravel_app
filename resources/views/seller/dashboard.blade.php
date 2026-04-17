<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Seller Dashboard') }}
            </h2>
            <a href="{{ route('items.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-sm font-bold py-2 px-4 rounded-lg shadow transition">
                + Post New Item
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-6 text-gray-800 border-b pb-4">Manage Your Listings</h3>

                    <div class="space-y-6">
                        @forelse($items as $item)
                            <div class="flex flex-col md:flex-row items-center bg-gray-50 border border-gray-100 rounded-lg p-4 gap-4 hover:shadow-sm transition">
                                
                                <!-- Item Image -->
                                <div class="w-full md:w-32 h-24 bg-gray-200 rounded-md overflow-hidden flex-shrink-0">
                                    @if($item->images->count() > 0)
                                        <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="flex items-center justify-center h-full text-gray-400 text-xs text-center p-2">No Image</div>
                                    @endif
                                </div>
                                
                                <!-- Item Details -->
                                <div class="flex-grow text-center md:text-left">
                                    <h4 class="text-xl font-bold text-gray-900">{{ $item->title }}</h4>
                                    <p class="text-sm font-medium text-blue-600">{{ $item->category->name }} &bull; <span class="text-gray-700">₱{{ number_format($item->price, 2) }}</span></p>
                                    <p class="text-xs text-gray-500 mt-1">Posted on {{ $item->created_at->format('M d, Y') }}</p>
                                </div>

                                <!-- Status Badge & Actions -->
                                <div class="flex flex-wrap items-center justify-center md:justify-end gap-2 mt-4 md:mt-0 w-full md:w-auto">
                                    <span class="px-3 py-1 mr-2 rounded-full text-xs font-bold uppercase tracking-wider border {{ $item->status === 'Available' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-gray-100 text-gray-600 border-gray-300' }}">
                                        {{ $item->status }}
                                    </span>

                                    <form action="{{ route('seller.items.toggle-status', $item) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-xs bg-white border border-gray-300 hover:bg-gray-100 text-gray-700 py-1.5 px-3 rounded-md transition font-semibold">
                                            Mark {{ $item->status === 'Available' ? 'Sold' : 'Available' }}
                                        </button>
                                    </form>

                                    <form action="{{ route('seller.items.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this listing permanently?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs bg-red-50 border border-red-200 hover:bg-red-100 text-red-600 py-1.5 px-3 rounded-md transition font-semibold">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-500 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <p class="mt-4 text-sm">You haven't posted any items yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
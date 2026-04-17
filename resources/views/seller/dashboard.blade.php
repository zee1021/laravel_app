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

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($items as $item)
                            <div class="group bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col">
                                
                                <!-- Item Image & Floating Badge -->
                                <div class="relative w-full h-48 bg-gray-50 overflow-hidden">
                                    @if($item->images->count() > 0)
                                        <img src="{{ asset('storage/' . $item->images->first()->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="flex items-center justify-center h-full text-gray-400 text-sm">No Image</div>
                                    @endif
                                    <div class="absolute top-3 right-3">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide shadow-sm {{ $item->status === 'Available' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $item->status }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Item Details -->
                                <div class="p-5 flex-grow flex flex-col">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="text-lg font-bold text-gray-900 line-clamp-1" title="{{ $item->title }}">{{ $item->title }}</h4>
                                        <p class="text-lg font-extrabold text-blue-600 ml-3">₱{{ number_format($item->price, 0) }}</p>
                                    </div>
                                    <p class="text-sm font-medium text-gray-500 mb-4">{{ $item->category->name }} &bull; <span class="font-normal text-gray-400">Posted {{ $item->created_at->format('M d, Y') }}</span></p>

                                    <!-- Actions -->
                                    <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between gap-3">
                                        <form action="{{ route('seller.items.toggle-status', $item) }}" method="POST" class="flex-1">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="w-full text-sm bg-gray-50 hover:bg-gray-100 text-gray-700 py-2 px-3 rounded-lg transition font-medium">
                                                Mark {{ $item->status === 'Available' ? 'Sold' : 'Available' }}
                                            </button>
                                        </form>

                                        <a href="{{ route('seller.items.edit', $item) }}" class="text-sm bg-blue-50 hover:bg-blue-100 text-blue-600 p-2 rounded-lg transition font-medium flex items-center justify-center" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>

                                        <form action="{{ route('seller.items.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this listing permanently?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm bg-red-50 hover:bg-red-100 text-red-600 p-2 rounded-lg transition font-medium flex items-center justify-center" title="Delete">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
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
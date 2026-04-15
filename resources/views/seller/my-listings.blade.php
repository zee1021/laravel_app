<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold">My Listings</h2>
                        <a href="{{ route('items.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Post New Item
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($items->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm">
                                        <th class="py-3 px-6 text-left">Image</th>
                                        <th class="py-3 px-6 text-left">Title</th>
                                        <th class="py-3 px-6 text-left">Price</th>
                                        <th class="py-3 px-6 text-left">Location</th>
                                        <th class="py-3 px-6 text-left">Status</th>
                                        <th class="py-3 px-6 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr class="border-b border-gray-200">
                                            <td class="py-3 px-6">
                                                @if($item->images->first())
                                                    <img src="{{ Storage::url($item->images->first()->image_path) }}" class="w-12 h-12 object-cover rounded">
                                                @else
                                                    <div class="w-12 h-12 bg-gray-200 rounded"></div>
                                                @endif
                                            </td>
                                            <td class="py-3 px-6">{{ $item->title }}</td>
                                            <td class="py-3 px-6">₱{{ number_format($item->price, 2) }}</td>
                                            <td class="py-3 px-6">{{ $item->location ?? 'N/A' }}</td>
                                            <td class="py-3 px-6">
                                                <span class="px-2 py-1 rounded text-xs {{ $item->status === 'Available' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                                    {{ $item->status }}
                                                </span>
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <form action="{{ route('seller.items.toggle-status', $item) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-yellow-600 hover:text-yellow-900 mr-2 text-sm">
                                                        {{ $item->status === 'Available' ? 'Mark Sold' : 'Mark Available' }}
                                                    </button>
                                                </form>
                                                <a href="{{ route('seller.items.edit', $item) }}" class="text-blue-600 hover:text-blue-900 mr-2 text-sm">Edit</a>
                                                <form action="{{ route('seller.items.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Delete this item?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                                </form>
                                            </td>
                                         </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $items->links() }}
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">You haven't posted any items yet.</p>
                            <a href="{{ route('items.create') }}" class="inline-block mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Post Your First Item
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
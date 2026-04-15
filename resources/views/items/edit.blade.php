<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">Edit Item: {{ $item->title }}</h2>

                    <form action="{{ route('seller.items.update', $item) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-bold mb-2">Title *</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $item->title) }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="price" class="block text-gray-700 font-bold mb-2">Price (₱) *</label>
                                <input type="number" name="price" id="price" value="{{ old('price', $item->price) }}" step="0.01" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                @error('price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="location" class="block text-gray-700 font-bold mb-2">Location</label>
                                <input type="text" name="location" id="location" value="{{ old('location', $item->location) }}" class="w-full border-gray-300 rounded-md shadow-sm">
                                @error('location') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="block text-gray-700 font-bold mb-2">Category *</label>
                            <select name="category_id" id="category_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="condition" class="block text-gray-700 font-bold mb-2">Condition *</label>
                            <select name="condition" id="condition" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="New" {{ old('condition', $item->condition) == 'New' ? 'selected' : '' }}>New</option>
                                <option value="Used" {{ old('condition', $item->condition) == 'Used' ? 'selected' : '' }}>Used</option>
                            </select>
                            @error('condition') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold mb-2">Description *</label>
                            <textarea name="description" id="description" rows="5" class="w-full border-gray-300 rounded-md shadow-sm" required>{{ old('description', $item->description) }}</textarea>
                            @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('seller.dashboard') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">Cancel</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
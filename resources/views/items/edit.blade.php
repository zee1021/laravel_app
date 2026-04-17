<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Item:') }} {{ $item->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    <form method="POST" action="{{ route('seller.items.update', $item) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <!-- Title -->
                            <div>
                                <x-input-label for="title" :value="__('Item Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $item->title)" required autofocus />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="5">{{ old('description', $item->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Price -->
                                <div>
                                    <x-input-label for="price" :value="__('Price (₱)')" />
                                    <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price', $item->price)" required step="0.01" min="0" />
                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                </div>

                                <!-- Category -->
                                <div>
                                    <x-input-label for="category_id" :value="__('Category')" />
                                    <select name="category_id" id="category_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="" disabled>Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Condition -->
                                <div>
                                    <x-input-label for="condition" :value="__('Condition')" />
                                    <select name="condition" id="condition" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                        <option value="" disabled>Select condition</option>
                                        <option value="New" {{ old('condition', $item->condition) == 'New' ? 'selected' : '' }}>New</option>
                                        <option value="Used - Like New" {{ old('condition', $item->condition) == 'Used - Like New' ? 'selected' : '' }}>Used - Like New</option>
                                        <option value="Used - Good" {{ old('condition', $item->condition) == 'Used - Good' ? 'selected' : '' }}>Used - Good</option>
                                        <option value="Used - Fair" {{ old('condition', $item->condition) == 'Used - Fair' ? 'selected' : '' }}>Used - Fair</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('condition')" class="mt-2" />
                                </div>

                                <!-- Location -->
                                <div>
                                    <x-input-label for="location" :value="__('Location (City, Province)')" />
                                    <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location', $item->location)" />
                                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Existing Images (Delete option) -->
                            @if($item->images->count() > 0)
                                <div>
                                    <x-input-label :value="__('Current Images (Check to remove)')" />
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-2">
                                        @foreach($item->images as $image)
                                            <div class="relative border rounded p-2 flex flex-col items-center bg-gray-50">
                                                <img src="{{ asset('storage/' . $image->image_path) }}" alt="Item Image" class="h-24 w-full object-cover rounded mb-2">
                                                <label class="inline-flex items-center text-sm text-red-600 font-semibold cursor-pointer">
                                                    <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500 mr-2">
                                                    Remove
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- New Images -->
                            <div>
                                <x-input-label for="images" :value="__('Upload Additional Images')" />
                                <input id="images" name="images[]" type="file" multiple class="block w-full text-sm text-gray-500 mt-1 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept="image/*">
                                <x-input-error :messages="$errors->get('images.*')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('seller.dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Cancel</a>
                            <x-primary-button>{{ __('Update Item') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
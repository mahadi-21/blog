<x-admin-layout>
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white flex justify-between items-center">
         
        <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold sm:text-5xl md:text-6xl">Edit Category</h1>
            <p class="mt-4 text-xl text-indigo-100">Update category information</p>
        </div>
        <div>
            <a href="{{ route('admin.categories') }}"
                class="inline-block bg-white text-indigo-600 px-6 py-3 rounded-lg hover:bg-indigo-50 transition font-medium shadow-lg">
                Back to Categories
            </a>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Edit Category: {{ $category->name }}</h3>
            </div>

            <form action="{{ route('admin.categories.update') }}" method="POST" class="p-6">
                @csrf
               

                <input type="number" hidden value="{{$category->id}}" name="id">
                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Category Name *</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Description</label>
                    <textarea name="description" rows="3" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $category->description) }}</textarea>
                </div>

                <!-- Icon and Color -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    

                    
                </div>

                <!-- Featured -->
                {{-- <div class="mb-6">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="is_featured" value="1" {{ $category->is_featured ? 'checked' : '' }} 
                               class="rounded border-gray-300 text-indigo-600">
                        <span class="text-gray-700 text-sm">Feature this category</span>
                    </label>
                </div> --}}

                <!-- Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.categories') }}" 
                       class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
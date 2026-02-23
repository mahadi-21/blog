<x-admin-layout>
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-extrabold sm:text-5xl md:text-6xl">Create Category</h1>
                    <p class="mt-4 text-xl text-indigo-100">Add a new category to organize your content</p>
                </div>
                <div>
                    <a href="{{ route('admin.categories') }}"
                        class="inline-block bg-white text-indigo-600 px-6 py-3 rounded-lg hover:bg-indigo-50 transition font-medium shadow-lg">
                        Back to Categories
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Category Details</h3>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST" class="p-6">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Category Name *</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                        placeholder="e.g., Technology">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                

                <!-- Description -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('description') border-red-500 @enderror"
                        placeholder="Category description...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            
                <div class="flex justify-end space-x-3 border-t pt-6">
                    <a href="{{ route('admin.categories') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition flex items-center">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Create Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
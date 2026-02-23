@extends('layouts.blog')

@section('title', 'Create New Post - BlogSpace')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-bold text-gray-900">Create New Post</h1>
        </div>

        <form class="p-6" method="POST" action="{{ route('author.post.store') }}" enctype="multipart/form-data">
            @csrf
            
            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Post Title</label>
                <input type="text" 
                       name="title" 
                       id="title"
                       value="{{ old('title') }}"
                       class="w-full rounded-lg border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('title') border-red-500 @enderror" 
                       placeholder="Enter your post title">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-6">
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select name="category_id" 
                        id="category_id"
                        class="w-full rounded-lg border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('category_id') border-red-500 @enderror">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Featured Image -->
            <div class="mb-6">
                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-indigo-400 transition-colors" 
                     id="dropzone"
                     onclick="document.getElementById('featured_image').click()">
                    <i class="fa-solid fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                    <p class="text-sm text-gray-600">Drag and drop an image, or click to select</p>
                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 2MB</p>
                    <input type="file" 
                           name="featured_image" 
                           id="featured_image" 
                           class="hidden" 
                           accept="image/png, image/jpeg, image/gif, image/webp"
                           onchange="previewImage(this)">
                </div>
                
                <!-- Image Preview -->
                <div id="imagePreview" class="mt-4 hidden">
                    <div class="relative inline-block">
                        <img src="" alt="Preview" class="max-h-48 rounded-lg shadow-md">
                        <button type="button" 
                                onclick="removeImage()"
                                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600">
                            <i class="fa-solid fa-times text-sm"></i>
                        </button>
                    </div>
                </div>
                
                @error('featured_image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea name="content" 
                          id="content" 
                          rows="12" 
                          class="w-full rounded-lg border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('content') border-red-500 @enderror" 
                          placeholder="Write your post content here...">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Excerpt -->
            <div class="mb-6">
                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt</label>
                <textarea name="excerpt" 
                          id="excerpt" 
                          rows="3" 
                          class="w-full rounded-lg border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('excerpt') border-red-500 @enderror" 
                          placeholder="Brief description of your post">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-end space-x-4">
                <button type="submit" name="status" value="draft" 
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Save as Draft
                </button>
                <button type="submit" name="status" value="pending" 
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Publish Post
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Image Preview Function
    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const previewImg = preview.querySelector('img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    // Remove Image Function
    function removeImage() {
        const input = document.getElementById('featured_image');
        const preview = document.getElementById('imagePreview');
        
        input.value = '';
        preview.classList.add('hidden');
    }
    
    // Drag and Drop Functionality
    const dropzone = document.getElementById('dropzone');
    
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, unhighlight, false);
    });
    
    function highlight() {
        dropzone.classList.add('border-indigo-500', 'bg-indigo-50');
    }
    
    function unhighlight() {
        dropzone.classList.remove('border-indigo-500', 'bg-indigo-50');
    }
    
    dropzone.addEventListener('drop', handleDrop, false);
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            document.getElementById('featured_image').files = files;
            previewImage(document.getElementById('featured_image'));
        }
    }
</script>
@endsection
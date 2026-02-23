@extends('layouts.blog')

@section('title', 'Contact Us - BlogSpace')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white ">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8 text-center gap-6">
        <h1 class="text-4xl font-extrabold sm:text-5xl md:text-6xl">Get in Touch</h1>
        <p class="mt-6 max-w-2xl mx-auto text-xl">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
    </div>
</div>

<!-- Contact Info Cards -->
<div class="max-w-7xl mx-auto mt-12 px-4 sm:px-6 lg:px-8 gap-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <div class="bg-indigo-100 w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-envelope text-xl text-indigo-600"></i>
            </div>
            <h3 class="font-semibold text-gray-900">Email Us</h3>
            <p class="text-gray-600 mt-2">support@blogspace.com</p>
            <p class="text-gray-600">info@blogspace.com</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <div class="bg-purple-100 w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-phone text-xl text-purple-600"></i>
            </div>
            <h3 class="font-semibold text-gray-900">Call Us</h3>
            <p class="text-gray-600 mt-2">+880123456789</p>
            <p class="text-gray-600">Mon-Fri, 9am-6pm EST</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <div class="bg-pink-100 w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-location-dot text-xl text-pink-600"></i>
            </div>
            <h3 class="font-semibold text-gray-900">Visit Us</h3>
            <p class="text-gray-600 mt-2">123 Blog Street</p>
            <p class="text-gray-600">Dhaka, Bangladesh 1205</p>
        </div>
    </div>
</div>

<!-- Contact Form & Map -->
<div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Contact Form -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Send us a Message</h2>
            
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('blog.contact.submit') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Your Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Subject</label>
                    <input type="text" name="subject" value="{{ old('subject') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('subject') border-red-500 @enderror">
                    @error('subject')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-medium mb-2">Message</label>
                    <textarea name="message" rows="5" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-indigo-700 transition w-full">
                    Send Message
                    <i class="fa-solid fa-paper-plane ml-2"></i>
                </button>
            </form>
        </div>

        
    </div>
</div>


@endsection
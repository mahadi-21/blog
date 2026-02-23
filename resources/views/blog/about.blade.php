@extends('layouts.blog')

@section('title', 'About Us - BlogSpace')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold sm:text-5xl md:text-6xl">About BlogSpace</h1>
        <p class="mt-6 max-w-2xl mx-auto text-xl">Where ideas come to life and stories find their voice</p>
    </div>
</div>

<!-- Our Story -->
<div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Story</h2>
            <p class="text-gray-600 mb-4">Founded in 2020, BlogSpace started as a small platform for writers to share their passion. Today, we've grown into a vibrant community of over 10,000 writers and millions of readers worldwide.</p>
            <p class="text-gray-600 mb-4">We believe everyone has a story to tell. Whether you're an experienced writer or just starting your journey, BlogSpace provides the perfect platform to share your thoughts, expertise, and creativity with the world.</p>
            <div class="flex items-center space-x-4 mt-6">
                <div class="flex -space-x-2">
                    <img src="https://ui-avatars.com/api/?name=John+Doe" class="w-10 h-10 rounded-full border-2 border-white">
                    <img src="https://ui-avatars.com/api/?name=Jane+Smith" class="w-10 h-10 rounded-full border-2 border-white">
                    <img src="https://ui-avatars.com/api/?name=Bob+Wilson" class="w-10 h-10 rounded-full border-2 border-white">
                </div>
                <span class="text-gray-600">Join 10k+ writers</span>
            </div>
        </div>
       
    </div>
</div>

<!-- Mission & Vision -->
<div class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Our Mission & Vision</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="bg-indigo-100 w-24 h-16 rounded-lg flex items-center justify-center mb-4">
                    <i class="fa-solid fa-bullseye text-3xl text-indigo-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-2 px-4 py-4">Our Mission</h3>
                <p class="text-gray-600 px-4 py-4">To empower voices, foster connections, and create a space where quality content thrives and communities grow.</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="bg-indigo-100 w-24 h-16 rounded-lg flex items-center justify-center mb-4">
                    <i class="fa-solid fa-eye text-3xl text-purple-600"></i>
                </div>
                <h3 class="text-xl font-bold mb-2 px-4 py-4">Our Vision</h3>
                <p class="text-gray-600 px-4 py-4">To become the world's most beloved platform for sharing ideas, stories, and knowledge across every topic imaginable.</p>
            </div>
        </div>
    </div>
</div>

<!-- Stats -->
<div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="text-center">
            <div class="text-4xl font-bold text-indigo-600">{{ number_format($total_articles ?? 0) }}</div>
            <div class="text-gray-600 mt-2">Articles Published</div>
        </div>
        <div class="text-center">
            <div class="text-4xl font-bold text-indigo-600">{{ number_format($active_authors ?? 0) }}</div>
            <div class="text-gray-600 mt-2">Active Writers</div>
        </div>
        <div class="text-center">
            <div class="text-4xl font-bold text-indigo-600">2M+</div>
            <div class="text-gray-600 mt-2">Monthly Readers</div>
        </div>
        <div class="text-center">
            <div class="text-4xl font-bold text-indigo-600">150+</div>
            <div class="text-gray-600 mt-2">Countries</div>
        </div>
    </div>
</div>

<!-- Team -->
<div class="bg-gray-100 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Meet Our Team</h2>
            <p class="text-gray-600 mt-2">Passionate people making BlogSpace awesome</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['name' => 'Sarah Johnson', 'role' => 'Founder & CEO', 'color' => 'indigo'],
                ['name' => 'Mike Chen', 'role' => 'Editor-in-Chief', 'color' => 'purple'],
                ['name' => 'Emily Davis', 'role' => 'Content Lead', 'color' => 'pink'],
                ['name' => 'Alex Rodriguez', 'role' => 'Community Manager', 'color' => 'blue']
            ] as $member)
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($member['name']) }}&size=128" class="w-24 h-24 rounded-full mx-auto mb-4">
                <h3 class="text-lg font-bold">{{ $member['name'] }}</h3>
                <p class="text-{{ $member['color'] }}-600 text-sm">{{ $member['role'] }}</p>
                <div class="flex justify-center space-x-3 mt-4">
                    <a href="#" class="text-gray-400 hover:text-{{ $member['color'] }}-600"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-{{ $member['color'] }}-600"><i class="fa-brands fa-linkedin"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Join Us -->
<div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-3xl font-bold text-gray-900 mb-4">Ready to Share Your Story?</h2>
    <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Join thousands of writers who are already sharing their ideas on BlogSpace.</p>
    <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-indigo-700 transition inline-flex items-center">
        Start Writing Today
        <i class="fa-solid fa-arrow-right ml-2"></i>
    </a>
</div>
@endsection
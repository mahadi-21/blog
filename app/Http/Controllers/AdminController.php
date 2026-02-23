<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total_posts = Post::count();
        $total_users = User::where('role', 'author')->count();
        $total_categories = Category::count();
        $total_pending_posts = Post::where('status', 'pending')->count();

        $pendingArticles = Post::where('status', 'pending')->latest()->take(5)->get();

        return view('admin.dashboard', compact('total_posts', 'total_users', 'total_categories', 'total_pending_posts', 'pendingArticles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function users()
    {
        $users = User::where('role','author')->latest()->paginate(10);
        return view('admin.users',compact('users'));
    }
    
}

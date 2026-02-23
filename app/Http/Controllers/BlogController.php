<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['category', 'author'])->where('status','published')->latest()->paginate(10);
        
        return view('blog.articles', compact('posts'));
    }

    
    public function categories()
    {
        $total_categories = Category::count();
        $total_articles = Post::where('status','published')->count();
        $active_authors = User::where('role','author')->whereHas('posts', function($query) {
            $query->where('status', 'published');
        })->count();
        $categories = Category::withCount('posts')->latest()->paginate(5);

        return view('blog.categories', compact('total_categories', 'total_articles', 'active_authors', 'categories'));
    }

    
    public function about()
    {
         $total_articles = Post::where('status','published')->count();
        $active_authors = User::where('role','author')->whereHas('posts', function($query) {
            $query->where('status', 'published');
        })->count();
        return view('blog.about', compact('total_articles', 'active_authors'));
    }

    
    public function contact()
    {
        return view('blog.contact');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);
        try{
            DB::transaction(function() use ($request) {
                Contact::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'subject' => $request->subject,
                    'message' => $request->message,
                ]);
            });
            return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to submit contact form. Please try again.');
        }

     
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

    public function categoryshow($id)
    {
        return view('blog.categoryshow');
    }
}

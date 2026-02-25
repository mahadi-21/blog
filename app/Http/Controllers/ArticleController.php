<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendingArticles = Post::where('status','pending')->latest()->paginate(10);
        return view('admin.approve-articles',compact('pendingArticles'));
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
    public function show(Request $request)
    {
        $article = Post::findOrFail($request->id);
        if($article==null)
            {

                return redirect()->back()->with('error','No post or article exist');
            }
        return view('admin.article-view',compact('article'));
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
    public function destroy(Request $request)
    {
        $article = Post::findOrFail($request->id);
        DB::beginTransaction();
        try{
            $article->delete();
            DB::commit();
            return redirect()->back()->with('success','You have successfully delete a post');
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with('error','Something went wrong!!!');
        }
    }
    public function approve(Request $request)
    {
        $article = Post::findOrFail($request->id);
        DB::beginTransaction();
        try{
            $article->update([
                'status'=>'published',
            ]);
            DB::commit();
            return redirect()->back()->with('success','You have successfully approve a post');
        }
        catch(Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with('error','Something went wrong!!!');
        }
    }
}

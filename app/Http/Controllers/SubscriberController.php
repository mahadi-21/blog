<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Subscriber $subscriber)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscriber $subscriber)
    {
        //
    }

    public function subscribe(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);
        
        
        DB::beginTransaction();

        try {

            Subscriber::create([
                'email' => $request->email,
            ]);

            DB::commit();

            return redirect()->back()
                ->with('success', 'You have successfully subscribed to our system!');
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()

                ->with('error', 'Something went wrong.');
        }
    }
}

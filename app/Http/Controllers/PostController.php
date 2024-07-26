<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Post::all();
        return view('posts.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['title'=>'required']);
//        dd('dsf');
        $record = Post::create($request->all());
        flash()->success('success');
        return redirect()->route('post.index');
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
        $model = Post::findOrfail($id);
        return view('posts.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = Post::findOrfail($id);
        $record->update($request->all());
        flash()->success('Edited');
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = Post::findorfail($id);
        $record->delete();
        flash()->error('Deleted');
        return back();
    }
}

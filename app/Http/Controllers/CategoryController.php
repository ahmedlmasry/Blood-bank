<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Category::all();
        return view('categories.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required']);
//        dd('dsf');
        $record = Category::create($request->all());
        flash()->success('success');
        return redirect()->route('category.index');
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
        $model = Category::findOrfail($id);
        return view('categories.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = Category::findOrfail($id);
        $record->update($request->all());
        flash()->success('Edited');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = Category::findorfail($id);
        $record->delete();
        flash()->error('Deleted');
        return back();
    }
}

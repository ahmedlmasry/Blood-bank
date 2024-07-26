<?php

namespace App\Http\Controllers;

use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Governorate::all();
        return view('governorates.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('governorates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        $record = Governorate::create($request->all());
        flash()->success('success');
        return redirect()->route('governorate.index');
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
        $model = Governorate::findOrfail($id);
        return view('governorates.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = Governorate::findOrfail($id);
        $record->update($request->all());
        flash()->success('Edited');
        return redirect()->route('governorate.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = Governorate::findorfail($id);
        $record->delete();
        flash()->error('Deleted');
        return back();
    }
}

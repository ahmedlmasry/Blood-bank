<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = City::all();
        return view('cities.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $governorates = Governorate::all();
        return view('cities.create',compact('governorates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required']);
//        dd('dsf');
        $record = City::create($request->all());
        flash()->success('success');
        return redirect()->route('city.index');
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
        $model = City::findOrfail($id);
        return view('cities.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = City::findOrfail($id);
        $record->update($request->all());
        flash()->success('Edited');
        return redirect()->route('city.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = City::findorfail($id);
        $record->delete();
        flash()->error('Deleted');
        return back();
    }
}

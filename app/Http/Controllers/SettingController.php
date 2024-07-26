<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = Setting::all();
        return view('settings.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required']);
//        dd('dsf');
        $record = Setting::create($request->all());
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
        $model = Setting::findOrfail($id);
        //dd($model);
        return view('settings.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = Setting::findOrfail($id);
        $record->update($request->all());
        flash()->success('Edited');
        return redirect()->route('setting.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = Setting::findorfail($id);
        $record->delete();
        flash()->error('Deleted');
        return back();
    }
}

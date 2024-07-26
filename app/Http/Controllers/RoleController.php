<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = \Spatie\Permission\Models\Role::all();
        return view('roles.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $records = \Spatie\Permission\Models\Role::all();
        return view('roles.create', compact('records'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:roles,name',
            'permissions_list'=>'required|array'
        ]);
        $record = \Spatie\Permission\Models\Role::create($request->all());
        $record->permissions()->attach($request->permissions_list);
        flash()->success('success');
        return redirect()->route('role.index');
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
        $model = \Spatie\Permission\Models\Role::findOrfail($id);
        return view('roles.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['name'=>'required|unique:roles,name,'.$id,'permissions_list'=>'required|array']);
        $record = \Spatie\Permission\Models\Role::findOrfail($id);
        $record->update($request->all());
        $record->permissions()->sync($request->permissions_list);
        flash()->success('Edited');
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = \Spatie\Permission\Models\Role::findorfail($id);
        $record->delete();
        flash()->error('Deleted');
        return back();
    }
}

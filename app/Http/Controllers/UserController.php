<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $records = User::all();
        return view('users.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $records = User::all();
        $roles = \App\Models\Role::all();
        return view('users.create', compact('records','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:users,name',
            'email'=>'required|unique:users,email',
            'password'=>'required|confirmed',
            'roles_list'=> 'required|array'
        ]);
        $record = User::create($request->all());
        //$record->roles()->attach($request->roles_list);
        $record->assignRole($request->input('roles_list'));
        flash()->success('success');
        return redirect()->route('user.index');
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
        $model = User::findOrfail($id);
        return view('users.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['name'=>'required|unique:users,name,'.$id,'roles_list'=>'required|array']);
        $record = User::findOrfail($id);
        $record->update($request->all());
        $record->roles()->sync($request->roles_list);
        flash()->success('Edited');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = User::findorfail($id);
        $record->delete();
        flash()->error('Deleted');
        return back();
    }
    public function changePassword()
    {
        return view('users.changePassword');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required|confirmed',
        ]);
        if(Hash::check($request->get('old_password'), Auth::user()->password)) {
            Auth::user()->update([
                'password' => bcrypt($request->new_password)
            ]);
//            flash()->success('Password changed');
//            return redirect()->route('home');
            return redirect()->back()->with('success', 'Password changed');
        }
        else{
            return back()->withErrors(['old_password'=>'Old password does not match']);
        }

    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}

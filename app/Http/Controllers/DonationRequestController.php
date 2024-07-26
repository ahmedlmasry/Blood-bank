<?php

namespace App\Http\Controllers;

use App\Models\DonationRequest;
use Illuminate\Http\Request;

class DonationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = DonationRequest::all();
        return view('donationRequests.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('donationRequests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
        ]);
//        dd('dsf');
        $record = DonationRequest::create($request->all());
        flash()->success('success');
        return redirect()->route('client.index');
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
        $model = DonationRequest::findOrfail($id);
        return view('donationRequests.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $record = DonationRequest::findOrfail($id);
        $record->update($request->all());
        flash()->success('Edited');
        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $record = DonationRequest::findorfail($id);
        $record->delete();
        flash()->error('Deleted');
        return back();
    }
    public function search(Request $request)
    {
        $records = DonationRequest::where('name', 'LIKE', '%' . $request->search . '%')->get();
        return view('donationRequests.index', compact('records'));
    }

}

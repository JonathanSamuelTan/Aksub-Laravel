<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drivers = Driver::all();
        return view('dashboard', compact('drivers'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pict = $request->name .".". $request->file('picture')->getClientOriginalExtension();
        // save to public/storage/img
        $request->file('picture')->storeAs('public/img', $pict);
        Driver::Create([
           'name' => $request->name,
           'team' => $request->team,
            'picture' => 'default.jpg'           
        ]);
        return redirect()->route('dashboard');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $driver = Driver::find($id);

        // check if user upload new picture
        $pict = "";
        if($request->hasFile('picture')){
            $pict = $request->name .".". $request->file('picture')->getClientOriginalExtension();
            // save to public/storage/img
            $request->file('picture')->storeAs('public/img', $pict);
        }else{
            $pict = $driver->picture;
        }
        $driver->name = $request->name;
        $driver->team = $request->team;
        $driver->picture = $pict;
        $driver->save();
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $driver = Driver::find($id);
        // delete picture
        unlink(storage_path('app/public/img/'.$driver->picture));
        $driver->delete();
        return redirect()->route('dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::latest()->paginate(5);

        return view('buses.index',compact('buses'))->with('i',(request()->input('page',1)-1)*5);
    }


    public function create()
    {
        return view('buses.create');
    }


    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name'           => 'required',
            'ic_no'          => 'required|string|max:20',
            'student_id'     => 'required|string|max:255',
            'departure_date' => 'required|date',
            'pickup_point'   => 'required|string|max:255',
            'destination'    => 'required|string|max:255',
        ]);

        // Create new bus record
        Bus::create($request->all());

        // Redirect to index page with success message
        return redirect()->route('buses.index')->with('success', 'Booking created successfully.');
    }



    public function show(Bus $buses)
    {
        //
    }


    public function edit(Bus $bus)
    {
        return view('buses.edit',compact('bus'));
    }


    public function update(Request $request, Bus $bus)
    {
        // Validation rules
        $request->validate([
            'name'           => 'required',
            'ic_no'          => 'required|string|max:20',
            'student_id'     => 'required|string|max:255',
            'departure_date' => 'required|date',
            'pickup_point'   => 'required|string|max:255',
            'destination'    => 'required|string|max:255',
        ]);

        // Update the bus record
        $bus->update($request->all());

        // Redirect with success message
        return redirect()->route('buses.index')->with('success', 'Booking Updated Successfully');
    }



    public function destroy(Bus $bus)
    {
        $bus->delete();

        return redirect()->route('buses.index')->with('success','Booking Deleted Successfully.');
    }
}

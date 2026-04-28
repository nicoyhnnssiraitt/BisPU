<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Driver;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::with('driver')->get();
        return view('buses.index', compact('buses'));
    }

    public function create()
    {
        $drivers = Driver::where('status', 'active')->get();
        return view('buses.create', compact('drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'plate_number' => 'required|string|unique:buses,plate_number',
            'bus_type' => 'required|in:large,small',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        Bus::create($request->all());
        return redirect()->route('buses.index')->with('success', 'Bus berhasil ditambahkan!');
    }

    public function edit(Bus $bus)
    {
        $drivers = Driver::where('status', 'active')->get();
        return view('buses.edit', compact('bus', 'drivers'));
    }

    public function update(Request $request, Bus $bus)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'plate_number' => 'required|string|unique:buses,plate_number,' . $bus->id,
            'bus_type' => 'required|in:large,small',
            'capacity' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        $bus->update($request->all());
        return redirect()->route('buses.index')->with('success', 'Bus berhasil diupdate!');
    }

    public function destroy(Bus $bus)
    {
        $bus->delete();
        return redirect()->route('buses.index')->with('success', 'Bus berhasil dihapus!');
    }
}
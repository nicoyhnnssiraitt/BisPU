<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Bus;
use App\Models\Route;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['bus.driver', 'route'])
            ->where('status', 'active')
            ->orderBy('departure_time')
            ->get();
        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $buses = Bus::where('status', 'active')->get();
        $routes = Route::all();
        return view('schedules.create', compact('buses', 'routes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'route_id' => 'required|exists:routes,id',
            'departure_time' => 'required',
            'days' => 'required|in:weekday,weekend,everyday',
            'status' => 'required|in:active,inactive',
        ]);

        Schedule::create($request->all());
        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit(Schedule $schedule)
    {
        $buses = Bus::where('status', 'active')->get();
        $routes = Route::all();
        return view('schedules.edit', compact('schedule', 'buses', 'routes'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'route_id' => 'required|exists:routes,id',
            'departure_time' => 'required',
            'days' => 'required|in:weekday,weekend,everyday',
            'status' => 'required|in:active,inactive',
        ]);

        $schedule->update($request->all());
        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil diupdate!');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil dihapus!');
    }
}
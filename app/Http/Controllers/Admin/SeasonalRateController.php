<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeasonalRate;
use App\Models\RoomType;
use Illuminate\Http\Request;

class SeasonalRateController extends Controller
{
    public function index()
    {
        $rates = SeasonalRate::with('roomType')->latest()->paginate(10);
        return view('admin.seasonal-rates.index', compact('rates'));
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        return view('admin.seasonal-rates.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price_per_night' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        SeasonalRate::create($request->all());

        return redirect()->route('admin.seasonal-rates.index')->with('success', 'Harga dinamis berhasil ditambahkan.');
    }

    public function edit(SeasonalRate $seasonalRate)
    {
        $roomTypes = RoomType::all();
        return view('admin.seasonal-rates.edit', compact('seasonalRate', 'roomTypes'));
    }

    public function update(Request $request, SeasonalRate $seasonalRate)
    {
        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price_per_night' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        $seasonalRate->update($request->all());

        return redirect()->route('admin.seasonal-rates.index')->with('success', 'Harga dinamis berhasil diperbarui.');
    }

    public function destroy(SeasonalRate $seasonalRate)
    {
        $seasonalRate->delete();
        return redirect()->route('admin.seasonal-rates.index')->with('success', 'Harga dinamis berhasil dihapus.');
    }
}

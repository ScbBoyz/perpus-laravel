<?php

namespace App\Http\Controllers;

use App\Models\Visits;
use Illuminate\Http\Request;

class VisitsController extends Controller
{
    public function index()
    {
        $visits = Visits::all();

        return view('pages.visits.index', compact('visits'));
    }

    public function create()
    {
        return view('pages.visits.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'event_date' => ['required', 'date'],
            'agency' => ['required'],
            'phone' => ['required'],
        ]);

        $visits = Visits::create([
            'name' => $request->name,
            'event_date' => $request->event_date,
            'agency' => $request->agency,
            'phone' => $request->phone,
        ]);

        session()->flash('success', 'Visits created successfully');
        return redirect()->route('visits.index');
    }

    public function edit(Visits $visits)
    {
        return view('pages.visits.edit', compact('visits'));
    }

    public function update(Visits $visits, Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'event_date' => ['required', 'date'],
            'agency' => ['required'],
            'phone' => ['required'],
        ]);

        $visits->update([
            'name' => $request->name,
            'event_date' => $request->event_date,
            'agency' => $request->agency,
            'phone' => $request->phone,
        ]);

        session()->flash('success', 'Visits updated successfully');
        return redirect()->route('visits.index');
    }
}

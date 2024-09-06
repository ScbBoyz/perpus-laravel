<?php

namespace App\Http\Controllers;

use App\Models\Facilities;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
        public function index()
        {
            $facilities = Facilities::all();

            return view('pages.facilities.index', compact('facilities'));
        }

        public function create()
        {
            return view('pages.facilities.create');
        }

        public function store(Request $request)
        {
            $request->validate([
                'name'=>['required'],
                'quantity' =>['required'],
            ]);

            $facilities = Facilities::create([
                'name'=> $request->name,
                'quantity' => $request->quantity,
            ]);

            session()->flash('success', 'Facilities created successfully');
            return redirect()->route('facilities.index');
        }

        public function edit(Facilities $facilities)
        {
            return view('pages.facilities.edit', compact('facilities'));
        }

        public function update(Facilities $facilities, Request $request)
        {
            $request->validate([
                'name'=>['required'],
                'quantity' =>['required'],
            ]);

            $facilities->update([
                'name'=> $request->name,
                'quantity' => $request->quantity,
            ]);

            session()->flash('success', 'Facilities updated successfully');
            return redirect()->route('facilities.index');
        }

        public function destroy(Facilities $facilities)
        {
            $facilities->delete();

            session()->flash('success', 'Facilities deleted successfully');
            return redirect()->route('facilities.index');
        }
}

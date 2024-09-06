<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();

        return view('pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('pages.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $categories = Categories::create([
            'name' => $request->name,
        ]);

        session()->flash('success', 'Categories created successfully');
        return redirect()->route('categories.index');
    }

    public function edit(Categories $categories)
    {
        return view('pages.categories.edit', compact('categories'));
    }

    public function update(Categories $categories, Request $request)
    {
        $request->validate([
            'name' => ['required'],
        ]);

        $categories->update([
            'name' => $request->name,
        ]);

        session()->flash('success', 'Categories updated successfully');
        return redirect()->route('categories.index');
    }
}

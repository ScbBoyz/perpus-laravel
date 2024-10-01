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
            'type' => ['required'],
            'name' => ['required'],
        ]);

        $categories = Categories::create([
            'type' => $request->type,
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
            'type' => ['required'],
        ]);

        $categories->update([
            'type' => $request->type,
        ]);

        session()->flash('success', 'Categories updated successfully');
        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        // Temukan kategori berdasarkan ID
        $category = Categories::findOrFail($id);

        // Hapus kategori
        $category->delete();

        // Redirect atau response
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}

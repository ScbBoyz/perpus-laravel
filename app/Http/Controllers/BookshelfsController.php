<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookshelfs;
use App\Models\Categories;
use Illuminate\Http\Request;

class BookshelfsController extends Controller
{
    public function index()
    {
        $bookshelfs = Bookshelfs::all();

        return view('pages.bookshelfs.index', compact('bookshelfs'));
    }

        public function create()
    {
        $categories = Categories::all(); // Mengambil data categories
        $bookshelfs = Bookshelfs::all(); // Mengambil data bookshelfs dari database

        return view('pages.bookshelfs.create', compact('categories', 'bookshelfs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required'],
            'name' => ['required'],
        ]);

        $bookshelfs = Bookshelfs::create([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        session()->flash('success', 'Bookshelfs created successfully');
        return redirect()->route('bookshelfs.index');
    }

    public function edit(Bookshelfs $bookshelfs)
    {
        $categories = Categories::all();
        return view('pages.bookshelfs.edit', compact('categories', 'bookshelfs'));
    }

    public function update(Bookshelfs $bookshelfs, Request $request)
    {
        $request->validate([
            'code' => ['required'],
            'name' => ['required'],
        ]);

        $bookshelfs->update([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        session()->flash('success', 'Bookshelfs updated successfully');
        return redirect()->route('bookshelfs.index');
    }

    public function destroy(Bookshelfs $bookshelfs)
    {
        $bookshelfs->delete();

        session()->flash('success', 'Book deleted successfully');
        return redirect()->route('bookshelfs.index');
    }
}

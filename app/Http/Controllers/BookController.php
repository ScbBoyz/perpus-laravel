<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCode;
use Illuminate\Http\Request;
use App\Models\Categories;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('pages.book.index', compact('books'));
    }

    public function create()
    {
        // Mengambil semua kategori dari database
        $categories = Categories::all();

        // Mengirimkan data kategori ke view
        return view('pages.book.create', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'category_id' => ['required', 'exists:categories,id'],
        'code' => ['required'],
        'title' => ['required'],
        'description' => ['required'],
        'year' => ['required'],
        'publisher' => ['required'],
    ]);

    $category = Categories::find($request->category_id);

    $code = BookCode::create([
        'code' => $request->code,
    ]);

    Book::create([
        'book_code_id' => $code->id,
        'title' => $request->title,
        'description' => $request->description,
        'year' => $request->year,
        'publisher' => $request->publisher,
        'category_id' => $category->id,
    ]);

    session()->flash('success', 'Book created successfully');
    return redirect()->route('book.index');
}

    public function edit(Book $book)
    {
        return view('pages.book.edit', compact('book'));
    }

    public function update(Book $book, Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'code' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'year' => ['required'],
            'publisher' => ['required'],
        ]);

        $category = Categories::find($request->category_id);

        $code = BookCode::create([
            'code' => $request->code,
        ]);

        $book->update([
            'book_code_id' => $code->id,
            'title' => $request->title,
            'description' => $request->description,
            'year' => $request->year,
            'publisher' => $request->publisher,
            'category_id' => $category->id,
        ]);

        session()->flash('success', 'Book updated successfully');
        return redirect()->route('book.index');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        session()->flash('success', 'Book deleted successfully');
        return redirect()->route('book.index');
    }
}

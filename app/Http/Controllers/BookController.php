<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCode;
use App\Models\Bookshelfs;
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
        $categories = Categories::all();
        $bookshelfs = Bookshelfs::all();
        return view('pages.book.create', compact('categories', 'bookshelfs'));
    }

    public function store(Request $request)
{
    $request->validate([
        'category_id' => ['required', 'exists:categories,id'],
        'book_shelf_id' => ['required', 'exists:bookshelfs,id'],
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
        'book_shelf_id' => $request->book_shelf_id,
    ]);

    session()->flash('success', 'Book created successfully');
    return redirect()->route('book.index');
}

    public function edit(Book $book)
    {
        $bookshelfs = Bookshelfs::all();
        $categories = Categories::all();
        return view('pages.book.edit', compact('book', 'bookshelfs', 'categories'));
    }

    public function update(Book $book, Request $request)
    {
        $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'book_shelf_id' => ['required', 'exists:bookshelfs,id'],
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
            'book_shelf_id' => $request->book_shelf_id,
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

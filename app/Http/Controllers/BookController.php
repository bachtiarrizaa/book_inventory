<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Book::with('author')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'cover' => 'nullable|string',
            'publisher' => 'nullable|string',
            'synopsis' => 'nullable|string',
            'publish_year' => 'nullable|integer',
            'genre' => 'nullable|string',
            'author_id' => 'required|exists:authors,id',
        ]);

        return Book::create($request->all());
    }

    public function show($id)
    {
        return Book::with('author')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());
        return $book;
    }

    public function destroy($id)
    {
        Book::destroy($id);
        return response()->noContent();
    }
}

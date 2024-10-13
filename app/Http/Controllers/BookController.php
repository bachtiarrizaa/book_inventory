<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->get();
        return response()->json([
            'message' => 'List of books retrieved successfully.',
            'data' => $books,
        ]);
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

        $book = Book::create($request->all());
        
        return response()->json([
            'message' => 'Book created successfully.',
            'data' => $book,
        ], 201); // Status 201 untuk created
    }

    public function show($id)
    {
        $book = Book::with('author')->findOrFail($id);
        return response()->json([
            'message' => 'Book retrieved successfully.',
            'data' => $book,
        ]);
    }

    public function search(Request $request)
    {
        // Ambil parameter title dari URL
        $query = $request->query('title'); // Menggunakan query() untuk mendapatkan parameter dari URL
        
        // Validasi input
        if (!$query) {
            return response()->json(['error' => 'Query parameter title is required.'], 400);
        }

        // Pencarian buku berdasarkan title
        $books = Book::where('title', 'LIKE', '%' . $query . '%')->get();

        // Respons JSON
        return response()->json([
            'message' => 'Books searched successfully.',
            'data' => $books,
        ]);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());

        return response()->json([
            'message' => 'Book updated successfully.',
            'data' => $book,
        ]);
    }

    public function destroy($id)
    {
        Book::destroy($id);
        return response()->json([
            'message' => 'Book deleted successfully.',
        ], 200); // Mengubah status menjadi 200 OK
    }
}

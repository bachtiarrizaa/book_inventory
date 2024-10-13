<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Mendapatkan daftar semua buku
    public function index()
    {
        $books = Book::with('author')->get();
        return response()->json($books);
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $book = Book::create($request->all());
        return response()->json($book, 201);
    }

    // Mendapatkan detail buku berdasarkan ID
    public function show($id)
    {
        $book = Book::with('author')->findOrFail($id);
        return response()->json($book);
    }

    // Memperbarui buku berdasarkan ID
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());
        return response()->json($book);
    }

    // Menghapus buku berdasarkan ID
    public function destroy($id)
    {
        Book::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}

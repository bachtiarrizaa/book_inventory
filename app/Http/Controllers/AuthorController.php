<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Mendapatkan daftar semua author
    public function index()
    {
        $authors = Author::with('books')->get();
        return response()->json($authors);
    }

    // Menyimpan author baru
    public function store(Request $request)
    {
        $author = Author::create($request->all());
        return response()->json($author, 201);
    }

    // Mendapatkan detail author berdasarkan ID
    public function show($id)
    {
        $author = Author::with('books')->findOrFail($id);
        return response()->json($author);
    }

    // Memperbarui author berdasarkan ID
    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->update($request->all());
        return response()->json($author);
    }

    // Menghapus author berdasarkan ID
    public function destroy($id)
    {
        Author::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}

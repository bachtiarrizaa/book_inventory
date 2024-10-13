<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return response()->json([
            'message' => 'List of authors retrieved successfully.',
            'data' => $authors,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|string',
            'birthdate' => 'nullable|date',
            'biography' => 'nullable|string',
        ]);

        $author = Author::create($request->all());

        return response()->json([
            'message' => 'Author created successfully.',
            'data' => $author,
        ], 201); // Status 201 untuk created
    }

    public function show($id)
    {
        $author = Author::findOrFail($id);
        return response()->json([
            'message' => 'Author retrieved successfully.',
            'data' => $author,
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $authors = Author::where('name', 'LIKE', "%{$query}%")
            ->orWhere('biography', 'LIKE', "%{$query}%")
            ->get();

        return response()->json([
            'message' => 'Authors searched successfully.',
            'data' => $authors,
        ]);
    }

    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);
        $author->update($request->all());
        
        return response()->json([
            'message' => 'Author updated successfully.',
            'data' => $author,
        ]);
    }

    public function destroy($id)
    {
        Author::destroy($id);
        return response()->json([
            'message' => 'Author deleted successfully.',
        ], 204); // Status 204 untuk no content
    }
}

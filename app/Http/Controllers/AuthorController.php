<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorController extends Controller
{
    public function index()
    {
        try {
            $authors = Author::all();
            return response()->json([
                'message' => 'List of authors retrieved successfully.',
                'data' => $authors,
            ], 200);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'message' => 'Something went wrong while retrieving authors. Please try again later.',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
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
            ], 201);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'message' => 'Something went wrong while creating the author. Please try again later.',
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $author = Author::findOrFail($id);
            return response()->json([
                'message' => 'Author retrieved successfully.',
                'data' => $author,
            ], 200);
        } catch (ModelNotFoundException $e) {
            report($e);
            return response()->json([
                'message' => 'Author not found. Please check the ID and try again.',
            ], 404);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'message' => 'Something went wrong while retrieving the author. Please try again later.',
            ], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $query = $request->input('query');

            $authors = Author::where('name', 'LIKE', "%{$query}%")
                ->orWhere('biography', 'LIKE', "%{$query}%")
                ->get();

            return response()->json([
                'message' => 'Authors searched successfully.',
                'data' => $authors,
            ], 200);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'message' => 'Something went wrong while searching authors. Please try again later.',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $author = Author::findOrFail($id);
            $author->update($request->all());

            return response()->json([
                'message' => 'Author updated successfully.',
                'data' => $author,
            ], 200);
        } catch (ModelNotFoundException $e) {
            report($e);
            return response()->json([
                'message' => 'Author not found. Please check the ID and try again.',
            ], 404);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'message' => 'Something went wrong while updating the author. Please try again later.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Author::findOrFail($id)->delete();
            return response()->json([
                'message' => 'Author deleted successfully.',
            ], 200);
        } catch (ModelNotFoundException $e) {
            report($e);
            return response()->json([
                'message' => 'Author not found. Please check the ID and try again.',
            ], 404);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'message' => 'Something went wrong while deleting the author. Please try again later.',
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = $request->query('title');

            if ($query) {
                $books = Book::with('author')
                    ->where('title', 'LIKE', '%' . $query . '%')
                    ->get();

                if ($books->isEmpty()) {
                    return response()->json([
                        'message' => 'No books found with the given title.'
                    ], 404);
                }

                return response()->json([
                    'message' => 'Books matching the search criteria retrieved successfully.',
                    'data' => $books,
                ], 200);
            }

            $books = Book::with('author')->get();
            return response()->json([
                'message' => 'List of books retrieved successfully.',
                'data' => $books,
            ], 200);

        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'message' => 'Something went wrong while retrieving books. Please try again later.',
            ], 500);
        }
    }


    public function store(Request $request)
    {
        try {
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
            ], 201);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'message' => 'Something went wrong while creating the book. Please try again later.',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $book = Book::findOrFail($id);
            $book->update($request->all());

            return response()->json([
                'message' => 'Book updated successfully.',
                'data' => $book,
            ], 200);
        } catch (ModelNotFoundException $e) {
            report($e);
            return response()->json([
                'message' => 'Book not found. Please check the ID and try again.',
            ], 404);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'message' => 'Something went wrong while updating the book. Please try again later.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Book::findOrFail($id)->delete();
            return response()->json([
                'message' => 'Book deleted successfully.',
            ], 200);
        } catch (ModelNotFoundException $e) {
            report($e);
            return response()->json([
                'message' => 'Book not found. Please check the ID and try again.',
            ], 404);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'message' => 'Something went wrong while deleting the book. Please try again later.',
            ], 500);
        }
    }
}

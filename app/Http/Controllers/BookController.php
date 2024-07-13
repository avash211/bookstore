<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function create()
    {
        return view('book.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'book_number' => 'required|string|unique:books,book_number',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation
        ]);

        $book = new Book();
        $book->name = $request->name;
        $book->author = $request->author;
        $book->book_number = $request->book_number;
        $book->price = $request->price;
        $book->quantity = $request->quantity;

        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('images', 'public');
            $book->img = $imagePath;
        }

        $book->save();

        Session::flash('success', 'The item was successfully saved.');
        return redirect()->route('book.details')->with('success', 'Book details saved successfully.');
    }

    public function fetchBookDetails($book_number)
    {
        $book = Book::where('book_number', $book_number)->first();

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        return response()->json($book);
    }

    public function index()
    {
        $books = Book::all();
        return view('list.list', compact('books'));
    }

    public function edit($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return redirect()->route('book.list')->with('error', 'Book not found.');
        }

        return view('book.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'book_number' => 'required|string|unique:books,book_number,' . $id,
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add image validation
        ]);

        $book = Book::find($id);

        if (!$book) {
            return redirect()->route('book.list')->with('error', 'Book not found.');
        }

        $book->name = $request->name;
        $book->author = $request->author;
        $book->book_number = $request->book_number;
        $book->price = $request->price;
        $book->quantity = $request->quantity;

        if ($request->hasFile('img')) {
            // Delete old image if exists
            if ($book->img) {
                Storage::disk('public')->delete($book->img);
            }
            $imagePath = $request->file('img')->store('images', 'public');
            $book->img = $imagePath;
        }

        $book->save();

        return redirect()
            ->route('book.edit', $book->id)
            ->with('success', 'Book updated successfully.');
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return redirect()->route('book.list')->with('error', 'Book not found.');
        }

        // Delete the image file if it exists
        if ($book->img) {
            Storage::disk('public')->delete($book->img);
        }

        $book->delete();

        return redirect()->route('book.list')->with('success', 'Book deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoldDetail;
use App\Models\Book;
use Illuminate\Validation\Rule;

class SoldController extends Controller
{
    public function index()
    {
        // Fetch all sold details with eager loading of book information
        $soldBooks = SoldDetail::with('book')->get();
        return view('sold.list', compact('soldBooks'));
    }

    public function create()
    {
        return view('sold.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'date' => 'required|date',
        'guest_name' => 'required|string|max:255',
        'book_number' => 'required|string',
        'quantity' => 'required|integer|min:1',
        'payment_mode' => 'required|string',
        'discount' => 'required|integer',
    ]);

    $book = Book::where('book_number', $request->book_number)->first();

    if (!$book) {
        return redirect()->back()->with('error', 'Book details not found for the provided book number.');
    }

    if ($book->quantity < $request->quantity) {
        return redirect()->back()->with('error', 'Insufficient quantity available for this book.');
    }

    $total = $this->calculateTotal($book->price, $request->quantity, $request->discount);

    // Store the SoldDetail with img from Book
    $soldDetail = SoldDetail::create([
        'date' => $request->date,
        'guest_name' => $request->guest_name,
        'book_name' => $book->name,
        'author_name' => $book->author,
        'price' => $book->price,
        'payment_mode' => $request->payment_mode,
        'discount' => $request->discount,
        'book_number' => $request->book_number,
        'quantity' => $request->quantity,
        'total' => $total,
        'img' => $book->img, // Ensure img is correctly assigned from Book
    ]);

    // Deduct sold quantity from Book
    $book->quantity -= $request->quantity;
    $book->save();

    return redirect()->route('sold.index')->with('success', 'Sold details saved successfully.');
}
    public function edit($id)
    {
        $soldDetail = SoldDetail::findOrFail($id);
        return view('sold.edit', compact('soldDetail'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'guest_name' => 'required|string|max:255',
            'book_number' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'payment_mode' => 'required|string',
            'discount' => 'required|integer',
        ]);

        $soldDetail = SoldDetail::findOrFail($id);
        $book = Book::where('book_number', $request->book_number)->first();

        if (!$book) {
            return redirect()->back()->with('error', 'Book details not found for the provided book number.');
        }

        $total = $this->calculateTotal($book->price, $request->quantity, $request->discount);

        $quantityDifference = $request->quantity - $soldDetail->quantity;

        $soldDetail->update([
            'date' => $request->date,
            'guest_name' => $request->guest_name,
            'book_name' => $book->name,
            'author_name' => $book->author,
            'price' => $book->price,
            'payment_mode' => $request->payment_mode,
            'discount' => $request->discount,
            'book_number' => $request->book_number,
            'quantity' => $request->quantity,
            'total' => $total,
            'img' => $book->img, // Update image field when updating
        ]);

        $book->quantity += $quantityDifference;
        $book->save();

        return redirect()->route('sold.index')->with('success', 'Sold details updated successfully.');
    }

    public function destroy($id)
    {
        $soldDetail = SoldDetail::findOrFail($id);
        $soldDetail->delete();

        return redirect()->route('sold.index')->with('success', 'Sold details deleted successfully.');
    }

    private function calculateTotal($price, $quantity, $discount)
    {
        return $price * $quantity * (1 - ($discount / 100));
    }
}

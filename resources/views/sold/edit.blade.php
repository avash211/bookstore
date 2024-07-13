@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h2>Edit Sold Detail</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('sold.update', $soldDetail->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" class="form-control" value="{{ $soldDetail->date }}">
            </div>
            <div class="form-group">
                <label for="guest_name">Guest Name:</label>
                <input type="text" id="guest_name" name="guest_name" class="form-control" value="{{ $soldDetail->guest_name }}">
            </div>
            <div class="form-group">
                <label for="book_number">Book Number:</label>
                <input type="text" id="book_number" name="book_number" class="form-control" value="{{ $soldDetail->book_number }}" readonly>
            </div>
            <div class="form-group">
                <label for="book_name">Book Name:</label>
                <input type="text" id="book_name" name="book_name" class="form-control" value="{{ $soldDetail->book_name }}" readonly>
            </div>
            <div class="form-group">
                <label for="author_name">Author Name:</label>
                <input type="text" id="author_name" name="author_name" class="form-control" value="{{ $soldDetail->author_name }}" readonly>
            </div>
            <div class="form-group">
                <label for="price">Price of Book:</label>
                <input type="text" id="price" name="price" class="form-control" value="{{ $soldDetail->price }}">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" class="form-control" value="{{ $soldDetail->quantity }}">
            </div>
            <div class="form-group">
                <label for="payment_mode">Mode of Payment:</label>
                <select id="payment_mode" name="payment_mode" class="form-control">
                    <option value="cash" {{ $soldDetail->payment_mode == 'cash' ? 'selected' : '' }}>Cash</option>
                    <option value="fonepay" {{ $soldDetail->payment_mode == 'fonepay' ? 'selected' : '' }}>Fonepay</option>
                    <option value="Esewa" {{ $soldDetail->payment_mode == 'Esewa' ? 'selected' : '' }}>Esewa</option>
                    <option value="Khalti" {{ $soldDetail->payment_mode == 'Khalti' ? 'selected' : '' }}>Khalti</option>
                    <option value="bank_transfer" {{ $soldDetail->payment_mode == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="discount">Discount:</label>
                <select id="discount" name="discount" class="form-control">
                    <option value="0" {{ $soldDetail->discount == 0 ? 'selected' : '' }}>None</option>
                    <option value="5" {{ $soldDetail->discount == 5 ? 'selected' : '' }}>Regular Customer - 5%</option>
                    <option value="15" {{ $soldDetail->discount == 15 ? 'selected' : '' }}>Festival - 15%</option>
                    <option value="10" {{ $soldDetail->discount == 10 ? 'selected' : '' }}>Employee - 10%</option>
                </select>
            </div>
            <div class="form-group">
                Total: <span id="total_amount">{{ $soldDetail->total }}</span>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>

@endsection

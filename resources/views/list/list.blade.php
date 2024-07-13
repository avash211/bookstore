<!-- resources/views/list/list.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Book Stock</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Book Number</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->book_number }}</td>
                        <td>{{ $book->price }}</td>
                        <td>{{ $book->quantity }}</td>
                        <td>
                            @if($book->img)
                                <img src="{{ asset('storage/' . $book->img) }}" alt="{{ $book->name }}" width="100">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('book.edit', $book->id) }}" class="btn btn-success btn-sm">Update</a>
                            <form action="{{ route('book.destroy', $book->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this book?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-danger" onclick="redirectToWelcome()">Back</button>
    </div>
    <script>
    function redirectToWelcome() {
        window.location.href = '{{ route('welcome') }}';
    }
    </script>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Book</h1>

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $book->name }}" required>
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" id="author" class="form-control" value="{{ $book->author }}" required>
            </div>

            <div class="form-group">
                <label for="book_number">Book Number</label>
                <input type="text" name="book_number" id="book_number" class="form-control" value="{{ $book->book_number }}" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ $book->price }}" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $book->quantity }}" required>
            </div>

            <div class="form-group">
                <label for="img">Book Image</label>
                <input type="file" name="img" id="img" class="form-control">
                @if ($book->img)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $book->img) }}" alt="{{ $book->name }}" width="100">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <button type="button" class="btn btn-danger" onclick="redirectToWelcome()" style="float: right">Back</button>
        </form>
    </div>
    <script>
        function redirectToWelcome() {
            window.location.href = '{{ route('welcome') }}';
        }
    </script>
@endsection

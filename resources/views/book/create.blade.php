@extends('layouts.app')

@section('content')
    <div class="card">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
        <div class="card-header">
            <h2>Enter Book Details</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('book.details') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name of Book:</label>
                    <input type="text" id="name" name="name" class="form-control" autocomplete="off">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="author">Author Name:</label>
                    <input type="text" id="author" name="author" class="form-control">
                    @error('author')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="book_number">Book Number:</label>
                    <input type="text" id="book_number" name="book_number" class="form-control">
                    @error('book_number')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="price">Price of Book:</label>
                    <input type="number" id="price" name="price" class="form-control">
                    @error('price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control">
                    @error('quantity')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="img">Book Image:</label>
                    <input type="file" id="img" name="img" class="form-control">
                    @error('img')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <button type="button" class="btn btn-danger" onclick="redirectToWelcome()" style="float: right">Back</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
    <script>
     function redirectToWelcome() {
        window.location.href = '{{ route('welcome') }}';
    }
    </script>

@endsection

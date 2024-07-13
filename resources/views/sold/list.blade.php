@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h2>Sold Books</h2>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Guest Name</th>
                    <th>Book Number</th>
                    <th>Book Name</th>
                    <th>Author Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($soldBooks as $soldBook)
                <tr>
                    <td>{{ $soldBook->date }}</td>
                    <td>{{ $soldBook->guest_name }}</td>
                    <td>{{ $soldBook->book_number }}</td>
                    <td>{{ $soldBook->book_name }}</td>
                    <td>{{ $soldBook->author_name }}</td>
                    <td>{{ $soldBook->price }}</td>
                    <td>
                        @if($soldBook->img)
                            <img src="{{ asset('storage/' . $soldBook->img) }}" alt="Book Image" class="img-thumbnail" style="width: 100px;">
                        @else
                            No Image Available
                        @endif
                    </td>
                    <td>{{ $soldBook->quantity }}</td>
                    <td>{{ $soldBook->total }}</td>
                    <td>
                        <a href="{{ route('sold.edit', $soldBook->id) }}" class="btn btn-sm btn-success">Update</a>
                        <form action="{{ route('sold.destroy', $soldBook->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-danger" onclick="redirectToWelcome()">Back</button>
    </div>
</div>

<script>
    function redirectToWelcome() {
        window.location.href = '{{ route('welcome') }}';
    }
</script>

@endsection

@extends('layouts.app')

@section('content')

<div class="card">
    @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
    <div class="card-header">
        <h2>Enter Details</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('sold.details') }}" method="POST" id="soldForm">
            @csrf
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" class="form-control" >
                @error('date')
                <div class="error">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group">
                <label for="guest_name">Guest Name:</label>
                <input type="text" id="guest_name" name="guest_name" class="form-control" >
                @error('guest_name')
                <div class="error">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group">
                <label for="book_number">Book Number:</label>
                <input type="text" id="book_number" name="book_number" class="form-control" >
                <small id="bookDetailsHelp" class="form-text text-muted">Enter the book number to fetch details.</small>
                @error('book_number')
                <div class="error">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group">
                <label for="book_name">Book Name:</label>
                <input type="text" id="book_name" name="book_name" class="form-control" readonly>

            </div>
            <div class="form-group">
                <label for="author_name">Author Name:</label>
                <input type="text" id="author_name" name="author_name" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="price">Price of Book:</label>
                <input type="text" id="price" name="price" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="img">Book Image:</label>
                <img id="bookImage" src="#" alt="Book Image" class="img-thumbnail" style="display: none; width: 100px;">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" class="form-control" >
                @error('quantity')
                <div class="error">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group">
                <label for="payment_mode">Mode of Payment:</label>
                <select id="payment_mode" name="payment_mode" class="form-control" >
                    <option value="cash">Cash</option>
                    <option value="fonepay">Fonepay</option>
                    <option value="Esewa">Esewa</option>
                    <option value="Khalti">Khalti</option>
                    <option value="bank_transfer">Bank Transfer</option>
                </select>
                @error('payment_mode')
                <div class="error">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group">
                <label for="discount">Discount:</label>
                <select id="discount" name="discount" class="form-control" >
                    <option value="0">None</option>
                    <option value="5">Regular Customer - 5%</option>
                    <option value="15">Festival - 15%</option>
                    <option value="10">Employee - 10%</option>
                </select>
                @error('discount')
                <div class="error">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group">
                Total: <span id="total_amount"></span>
            </div>
            <button type="button" onclick="fetchBookDetails()" class="btn btn-primary">Fetch Book Details</button>
            <button type="submit" class="btn btn-success">Submit</button>
            <button type="button" class="btn btn-danger" onclick="redirectToWelcome()" style="float: right">Back</button>

        </form>
    </div>
</div>

<!-- Your Blade view or HTML file -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    function fetchBookDetails() {
        var bookNumber = document.getElementById('book_number').value;

        // Perform AJAX request to fetch book details based on bookNumber
        axios.get('/books/' + bookNumber)
            .then(function(response) {
                var book = response.data;

                // Update the form fields with fetched book details
                document.getElementById('book_name').value = book.name;
                document.getElementById('author_name').value = book.author;
                document.getElementById('price').value = book.price;

                // Update the image src and display it
                if (book.img) {
                    var bookImage = document.getElementById('bookImage');
                    bookImage.src = '/storage/' + book.img;
                    bookImage.style.display = 'block';
                }

                calculateTotal(); // Update total based on fetched price
            })
            .catch(function(error) {
                console.error('Error fetching book details: ' + error);
                // Optionally handle errors or display messages to the user
            });
    }

    // Example JavaScript to update total dynamically based on selected discount
    document.getElementById('discount').addEventListener('change', function() {
        calculateTotal();
    });

    function calculateTotal() {
        var discount = parseInt(document.getElementById('discount').value);
        var price = parseFloat(document.getElementById('price').value);
        var quantity = parseInt(document.getElementById('quantity').value);

        var total = price * quantity * (1 - discount / 100);
        document.getElementById('total_amount').textContent = total.toFixed(2);
    }

    function redirectToWelcome() {
        window.location.href = '{{ route('welcome') }}';
    }
</script>

@endsection

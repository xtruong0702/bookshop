@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row align-items-center">
        <div class="col-md-5 text-center">
            <img src="{{ asset($book->image ? 'storage/' . $book->image : 'images/default-book.jpg') }}" 
                 alt="{{ $book->title }}" class="img-fluid rounded shadow-lg" style="max-width: 100%; height: auto;">
        </div>
        <div class="col-md-7">
            <h2 class="fw-bold text-primary">{{ $book->title }}</h2>
            <p class="text-muted fs-5">✍️ Tác giả: <strong>{{ $book->author }}</strong></p>
            <p class="lead text-justify">{{ $book->description }}</p>
            <h4 class="text-danger fw-bold">{{ number_format($book->price, 0, ',', '.') }} VNĐ</h4>

            <form action="{{ route('cart.add', $book->id) }}" method="POST">
                @csrf
                <button class="btn btn-lg btn-success mt-3">
                    🛒 Thêm vào giỏ hàng
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Danh Sách Sách')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-center text-primary">📚 Danh Sách Sách</h2>

    <!-- Chỉ Admin mới thấy nút Thêm Sách -->
    @if(auth()->check() && auth()->user()->role === 'admin')
        <div class="text-end mb-3">
            <a href="{{ route('books.create') }}" class="btn btn-success shadow">
                ➕ Thêm Sách Mới
            </a>
        </div>
    @endif

    @if($books->count() > 0)
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-lg border-0 rounded-4 overflow-hidden">
                        <img src="{{ asset($book->image ? 'storage/' . $book->image : 'images/default-book.jpg') }}" 
                             alt="{{ $book->title }}" class="card-img-top img-fluid" 
                             style="height: 220px; object-fit: cover;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate fw-bold">{{ $book->title }}</h5>
                            <p class="text-muted mb-2">✍ {{ $book->author }}</p>
                            <h5 class="text-danger fw-bold">{{ number_format($book->price, 0, ',', '.') }} VNĐ</h5>

                            <div class="mt-auto">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">
                                        👁 Xem
                                    </a>
                                    
                                    <!-- Chỉ Admin mới thấy nút Sửa và Xóa -->
                                    @if(auth()->check() && auth()->user()->role === 'admin')
                                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">
                                            ✏️ Sửa
                                        </a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline-block"
                                              onsubmit="return confirm('Bạn có chắc chắn muốn xóa sách này không?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger">🗑 Xóa</button>
                                        </form>
                                    @endif
                                </div>

                                <!-- Nút thêm vào giỏ hàng -->
                                <form action="{{ route('cart.add', $book->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary w-100 fw-bold">
                                        🛒 Thêm vào giỏ hàng
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('cart.index') }}" class="btn btn-dark shadow fw-bold px-4 py-2">
                🛍 Xem Giỏ Hàng
            </a>
        </div>
    @else
        <p class="text-center text-muted mt-4">📖 Chưa có sách nào trong cửa hàng.</p>
    @endif
</div>
@endsection

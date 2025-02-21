@extends('layouts.app')

@section('title', 'Danh Sách Sách')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-center text-primary">📚 Danh Sách Sách</h2>

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
                                        👁 Xem chi tiết sách
                                    </a>                                    
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

                                <button class="btn btn-outline-primary w-100 fw-bold add-to-cart" data-id="{{ $book->id }}">
                                    🛒 Thêm vào giỏ hàng
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('cart.index') }}" class="btn btn-dark shadow fw-bold px-4 py-2">
                🛍 Xem Giỏ Hàng <span id="cart-count" class="badge bg-danger ms-2">{{ session('cart') ? count(session('cart')) : 0 }}</span>
            </a>
        </div>
    @else
        <p class="text-center text-muted mt-4">📖 Chưa có sách nào trong cửa hàng.</p>
    @endif
</div>

<!-- Thông báo giỏ hàng (Toast) - Đặt ngoài container -->
<div id="cart-toast" class="toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3 p-3 shadow"
     role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 1050;">
    <div class="d-flex">
        <div class="toast-body" id="cart-message"></div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const cartButtons = document.querySelectorAll(".add-to-cart");

    cartButtons.forEach(button => {
        button.addEventListener("click", function () {
            let bookId = this.getAttribute("data-id");

            fetch("{{ route('cart.add', '') }}/" + bookId, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hiển thị Toast thông báo
                    let cartToastEl = document.getElementById("cart-toast");
                    let cartToast = new bootstrap.Toast(cartToastEl);
                    document.getElementById("cart-message").textContent = data.message;
                    cartToast.show();

                    // Cập nhật số lượng giỏ hàng
                    document.getElementById("cart-count").textContent = data.cart_count;
                }
            })
            .catch(error => console.error("Lỗi:", error));
        });
    });
});
</script>

@endsection

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

            <div class="d-flex gap-3 mt-4">
                <button class="btn btn-lg btn-success add-to-cart" data-id="{{ $book->id }}">
                    🛒 Thêm vào giỏ hàng
                </button>
                <a href="{{ route('home') }}" class="btn btn-lg btn-secondary">
                    🏠 Quay lại trang chủ
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Thông báo giỏ hàng (Toast) -->
<div id="cart-toast" class="toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3 p-3 shadow"
     role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 1050;">
    <div class="d-flex">
        <div class="toast-body" id="cart-message"></div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const addToCartBtn = document.querySelector(".add-to-cart");

    addToCartBtn.addEventListener("click", function () {
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
</script>
@endsection

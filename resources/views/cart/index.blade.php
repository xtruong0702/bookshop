@extends('layouts.app')

@section('title', 'Giỏ Hàng')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-center text-primary">🛒 Giỏ Hàng</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(empty($cart))
        <div class="text-center mt-4">
            <p class="text-muted fs-5">🛍 Giỏ hàng của bạn đang trống.</p>
            <a href="{{ route('home') }}" class="btn btn-outline-primary">📚 Tiếp tục mua sắm</a>
        </div>
    @else
        <div class="table-responsive mt-4">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>📸 Hình Ảnh</th>
                        <th>📖 Tên Sách</th>
                        <th>✍️ Tác Giả</th>
                        <th>💰 Giá</th>
                        <th>🔢 Số Lượng</th>
                        <th>💵 Tổng</th>
                        <th>⚙️ Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                        <tr>
                            <td>
                                <img src="{{ asset($item['image'] ? 'storage/' . $item['image'] : 'images/default-book.jpg') }}" 
                                     alt="{{ $item['title'] }}" class="img-thumbnail" width="60">
                            </td>
                            <td class="fw-semibold">{{ $item['title'] }}</td>
                            <td class="text-muted">{{ $item['author'] }}</td>
                            <td class="text-danger fw-bold">{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex justify-content-center align-items-center">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" 
                                           class="form-control text-center me-2" style="width: 60px;">
                                    <button type="submit" class="btn btn-sm btn-primary">✔</button>
                                </form>
                            </td>
                            <td class="text-success fw-bold">{{ number_format($subtotal, 0, ',', '.') }} VNĐ</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">🗑 Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-warning">
                        <td colspan="5" class="text-end fw-bold">💰 Tổng tiền:</td>
                        <td colspan="2" class="text-success fw-bold">{{ number_format($total, 0, ',', '.') }} VNĐ</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-secondary">🏠 Quay lại trang chủ</a>
            <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirmDelete();">
                @csrf
                <button type="submit" class="btn btn-warning">🗑 Xóa toàn bộ</button>
            </form>
            
            <script>
            function confirmDelete() {
                return confirm("Bạn có chắc chắn muốn xóa toàn bộ giỏ hàng không?");
            }
            </script>
            
            <a href="{{ route('checkout') }}" class="btn btn-success btn-lg">💳 Thanh Toán</a>
        </div>
    @endif
</div>
@endsection

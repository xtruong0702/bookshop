@extends('layouts.app')

@section('title', 'Giỏ Hàng')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-center text-primary">🛒 Giỏ Hàng</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($cart))
        <p class="text-center text-muted mt-4">🛍 Giỏ hàng trống.</p>
    @else
        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Hình Ảnh</th>
                    <th>Tên Sách</th>
                    <th>Tác Giả</th>
                    <th>Giá</th>
                    <th>Số Lượng</th>
                    <th>Tổng</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                    <tr>
                        <td><img src="{{ asset($item['image'] ?? 'images/default-book.jpg') }}" width="60" height="80"></td>
                        <td>{{ $item['title'] }}</td>
                        <td>{{ $item['author'] }}</td>
                        <td>{{ number_format($item['price'], 0, ',', '.') }} VNĐ</td>
                        <td>
                            <form action="{{ route('cart.update', $id) }}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="form-control d-inline-block" style="width: 60px;">
                                <button type="submit" class="btn btn-sm btn-primary">✔</button>
                            </form>
                        </td>
                        <td>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} VNĐ</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">🗑 Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-end">
            <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-warning">🗑 Xóa toàn bộ</button>
            </form>
            <a href="{{ route('checkout') }}" class="btn btn-success">💳 Thanh Toán</a>
        </div>
    @endif
</div>
@endsection

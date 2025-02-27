@extends('layouts.app')

@section('content')
    <div class="container text-center mt-5">
        <div class="card shadow-lg p-4">
            <h1 class="text-success fw-bold">🎉 Cảm ơn bạn đã thanh toán!</h1>
            <p class="fs-5 text-muted">Đơn hàng của bạn đã được xử lý thành công.</p>
            
            @if(session('order_id'))
                <p class="fw-bold">Mã đơn hàng: <span class="text-primary">{{ session('order_id') }}</span></p>
            @endif
            
            <a href="{{ route('home') }}" class="btn btn-lg btn-primary mt-3">🏠 Quay lại trang chủ</a>
        </div>
    </div>
@endsection

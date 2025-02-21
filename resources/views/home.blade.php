@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center my-4">
        <h1 class="fw-bold">Chào mừng đến với BookShop 📚</h1>
        <p class="text-muted">Mua sách dễ dàng, giao hàng nhanh chóng.</p>
    </div>

    <div class="row">
        @foreach ($books as $book)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ $book->image }}" class="card-img-top" alt="{{ $book->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="text-muted">{{ $book->author }}</p>
                        <p class="fw-bold text-danger">{{ number_format($book->price, 0, ',', '.') }} VNĐ</p>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@endsection

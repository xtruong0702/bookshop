@extends('layouts.app')

@section('title', 'Chỉnh Sửa Sách')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-center">✏️ Chỉnh Sửa Sách</h2>

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="title">Tên sách:</label>
        <input type="text" name="title" value="{{ $book->title }}" required class="form-control">

        <label for="author">Tác giả:</label>
        <input type="text" name="author" value="{{ $book->author }}" required class="form-control">

        <label for="price">Giá:</label>
        <input type="number" name="price" value="{{ $book->price }}" required class="form-control">

        <!-- Hiển thị ảnh hiện tại -->
        <div class="mt-3">
            <label>Ảnh hiện tại:</label>
            <br>
            <img src="{{ $book->image ? asset('storage/' . $book->image) : asset('images/default-book.jpg') }}" alt="{{ $book->title }}" class="img-thumbnail" width="150">
        </div>

        <!-- Upload ảnh mới -->
        <label for="image" class="mt-3">Chọn ảnh mới:</label>
        <input type="file" name="image" class="form-control">

        <button type="submit" class="btn btn-success mt-3">💾 Lưu</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">🔙 Quay lại</a>
    </form>
</div>
@endsection

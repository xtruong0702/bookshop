@extends('layouts.app')

@section('title', 'Thêm Sách Mới')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Thêm Sách Mới</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Tên sách:</label>
        <input type="text" name="title" required class="form-control">
    
        <label for="author">Tác giả:</label>
        <input type="text" name="author" required class="form-control">
    
        <label for="price">Giá:</label>
        <input type="number" name="price" required class="form-control">
    
        <label for="image">Hình ảnh:</label>
        <input type="file" name="image" class="form-control">
    
        <button type="submit" class="btn btn-success mt-3">Lưu</button>
    </form>
    
</div>
@endsection

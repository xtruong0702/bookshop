<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BookController extends Controller
{

    public function dashboard()
{
    $user = Auth::user(); // Lấy thông tin user đăng nhập
    return view('dashboard', compact('user'));
}
    // Hiển thị danh sách sách
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // Hiển thị form thêm sách
    public function create()
    {
        return view('books.create');
    }

    // Xử lý thêm sách mới
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra file ảnh
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('books', 'public');
    }

    Book::create([
        'title' => $request->title,
        'author' => $request->author,
        'price' => $request->price,
        'image' => $imagePath,
    ]);

    return redirect()->route('books.index')->with('success', 'Thêm sách thành công!');
}

    // Hiển thị chi tiết sách
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Hiển thị form chỉnh sửa sách
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    

    // Cập nhật thông tin sách
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            // Lưu ảnh mới
            $imagePath = $request->file('image')->store('books', 'public');
            $book->image = $imagePath;
        }
    
        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'price' => $request->price,
            'image' => $book->image,
        ]);
    
        return redirect()->route('books.index')->with('success', 'Cập nhật sách thành công!');
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('books', 'public') : null;

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
            $book->image = $request->file('image')->store('books', 'public');
        }

        $book->update($request->only(['title', 'author', 'price', 'image']));

        return redirect()->route('books.index')->with('success', 'Cập nhật sách thành công!');
    }

    // Xóa sách
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Xóa sách thành công!');
    }
}
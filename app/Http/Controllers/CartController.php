<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // Thêm sách vào giỏ hàng
    public function add(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId);
        $cart = session()->get('cart', []);

        if (isset($cart[$bookId])) {
            $cart[$bookId]['quantity'] += 1;
        } else {
            $cart[$bookId] = [
                'title' => $book->title,
                'author' => $book->author,
                'price' => $book->price,
                'image' => $book->image,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', "Đã thêm '{$book->title}' vào giỏ hàng!");
    }

    // Cập nhật số lượng sách trong giỏ hàng
    public function update(Request $request, $bookId)
    {
        $cart = session()->get('cart', []);
        if (!isset($cart[$bookId])) {
            return redirect()->route('cart.index')->with('error', 'Sách không có trong giỏ hàng!');
        }

        $quantity = max(1, (int) $request->quantity);
        $cart[$bookId]['quantity'] = $quantity;
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Cập nhật giỏ hàng thành công!');
    }

    // Xóa sách khỏi giỏ hàng
    public function remove($bookId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$bookId])) {
            unset($cart[$bookId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Sách đã được xóa khỏi giỏ hàng!');
    }

    // Xóa toàn bộ giỏ hàng
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được xóa sạch!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class CartController extends Controller
{
    /**
     * Hiển thị giỏ hàng
     */
    public function index()
    {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    /**
     * Thêm sách vào giỏ hàng
     */
    public function add(Request $request, Book $book)
    {
        $cart = session('cart', []);

        $cart[$book->id] = [
            'title'    => $book->title,
            'author'   => $book->author,
            'price'    => $book->price,
            'quantity' => ($cart[$book->id]['quantity'] ?? 0) + 1,
            'image'    => $book->image,
        ];

        session(['cart' => $cart]);

        return response()->json([
            'success'    => true,
            'message'    => 'Đã thêm vào giỏ hàng!',
            'cart_count' => $this->getCartTotalQuantity($cart),
        ]);
    }

    /**
     * Cập nhật số lượng sách trong giỏ hàng
     */
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


    /**
     * Xóa sách khỏi giỏ hàng
     */
    public function remove($bookId)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$bookId])) {
        unset($cart[$bookId]);
        session()->put('cart', $cart);
    }

    return redirect()->route('cart.index')->with('success', 'Sách đã được xóa khỏi giỏ hàng!');
}


    /**
     * Xóa toàn bộ giỏ hàng
     */
    public function clear()
{
    session()->forget('cart');

    return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được xóa sạch!');
}

    /**
     * Lấy tổng số lượng sách trong giỏ hàng
     */
    private function getCartTotalQuantity(array $cart): int
    {
        return array_sum(array_column($cart, 'quantity'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function viewcart()
    {
        $tableId = session('table_id');
        $table = Table::findOrFail($tableId);
        $carts = Cart::with('menu')->where('table_id', $tableId)->get();
        return view('rest.cart', [
            'carts' => $carts,
        ]);
    }

    public function addToCart(Request $request)
    {
         // Ambil data menu berdasarkan menu_id
    $menu = Menu::find($request->menu_id);

    // Ambil table_id dari session
    $tableId = $request->table_id;

    // Debugging untuk memastikan bahwa table_id diambil dari session
    if (!$tableId) {
        return response()->json(['message' => 'Table ID tidak ditemukan di session.'], 400);
    }

    // Cek apakah item sudah ada di keranjang untuk meja yang sama
    $cartItem = Cart::where('menu_id', $menu->id)
                    ->where('table_id', $tableId)
                    ->first();

    if ($cartItem) {
        // Jika item sudah ada, tambahkan quantity dan update total
        $cartItem->qty += 1;
        $cartItem->total = $cartItem->qty * $menu->price;
        $cartItem->save();
    } else {
        // Jika item belum ada, tambahkan item baru ke keranjang
        $cart = new Cart();
        $cart->menu_id = $menu->id;
        $cart->table_id = $tableId;  // Masukkan table_id dari session
        $cart->qty = 1;
        $cart->total = $menu->price;
        $cart->save();
    }

        return response()->json(['message' => 'Menu Sudah Dikeranjang!']);
    }



    // public function showCart($id)
    // {
    //     $cart = Cart::findOrFail($id);

    //     // Retrieve all cart items
    //     $carts = Cart::with('menu')->get();

    //     return view('cart.show', compact('carts'));
    // }

    public function destroy($id)
    {
        // Find the cart item by ID and delete it
        $cart = Cart::findOrFail($id);
        $cart->delete();

        // Redirect back to the cart page with a success message
        return redirect()->route('cart.cart')->with('success', 'Item removed successfully.');
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::find($id);

        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found.'], 404);
        }

        if ($request->input('action') === 'increment') {
            $cartItem->qty += 1;
        } elseif ($request->input('action') === 'decrement') {
            if ($cartItem->qty > 1) {
                $cartItem->qty -= 1;
            } else {
                $cartItem->delete(); // Hapus item jika qty tinggal 1
                return response()->json(['deleted' => true, 'id' => $cartItem->id]);
            }
        }

        // Menggunakan harga per unit (price) yang benar untuk menghitung ulang total
        $cartItem->total = $cartItem->qty * $cartItem->menu->price;
        $cartItem->save();

        return response()->json([
            'message' => 'Cart item updated successfully.',
            'cartItem' => $cartItem,
            'deleted' => false
        ]);
    }

    public function checkNotification()
    {
        try {
            $count = Cart::count(); // Pastikan Cart adalah model atau facade yang benar
            return response()->json(['count' => $count]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

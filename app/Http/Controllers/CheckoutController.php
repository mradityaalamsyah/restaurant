<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function view(){
        $tableId = session('table_id');

        $carts = Cart::with('menu')->where('table_id', $tableId)->get();

        $subtotal = $carts->sum('total');        
        
        return view('rest.checkout', [
            'carts' => $carts,
            'subtotal' => $subtotal
        ]);    
    }

    public function showCheckout()
    {
        // Retrieve all cart items
        $carts = Cart::with('menu')->get();
        
        return view('checkout.show', compact('carts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nameuser' => 'required',  
            'meja' => 'required'
        ], [
            'nameuser.required' => 'Nama wajib diisi'
        ]);

        $carts = Cart::whereIn('id', json_decode($request->carts))->get();

        $order = Order::create([
            'nameuser' => $request->nameuser,
                'note' => $request->note
        ]);

        foreach ($carts as $cart) {
            OrderItem::create([
                'table_id' => $request->meja,
                'order_id' => $order->id,
                'menu_id' => $cart->menu_id,
                'qty' => $cart->qty,
                'harga' => $cart->total,
            ]);

            $menu = Menu::find($cart->menu_id);
            if ($menu) {
                $menu->stock -= $cart->qty; // Assuming 'stock' is the field in the 'menu' table
                $menu->save();
            }

            $cart->delete();
        }

        return redirect('/success')->with('successh', 'Order berhasil disimpan dan stok telah diperbarui.');
    }
}

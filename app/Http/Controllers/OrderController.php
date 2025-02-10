<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Table;

class OrderController extends Controller
{
    public function ViewOrder()
    {
        $tableId = session('table_id');
        // $table = Table::findOrFail($tableId);
        $orders = OrderItem::with(['order', 'menu'])->where('table_id', $tableId)->get(); // perhatikan nama relasi yang benar
        $subtotal = $orders->sum('harga');

        return view('rest.orders', [
            'orders' => $orders,
            'subtotal' => $subtotal
        ]);
    }
    public function create()
    {
        $orders = OrderItem::with(['order', 'menu', 'table'])->get(); // perhatikan nama relasi yang benar
        $subtotal = $orders->sum('harga');

        return view('order.crudorder', [
            'orders' => $orders,
            'subtotal' => $subtotal
        ]);
    }
    public function destroy($orderItemId)
    {
        try {
            // Temukan dan hapus OrderItem, simpan order_id
            $orderItem = OrderItem::findOrFail($orderItemId);
            $orderId = $orderItem->order_id;
            $orderItem->delete();

            // Hapus Order jika tidak ada OrderItem yang tersisa
            if (!OrderItem::where('order_id', $orderId)->exists()) {
                Order::findOrFail($orderId)->delete();
            }

            return redirect()->back()->with('success', 'Pesanan berhasil diselesaikan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyelesaikan pesanan.');
        }
    }
}

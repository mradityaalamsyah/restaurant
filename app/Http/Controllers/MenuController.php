<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Table;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function create()
    {
        $menus = Menu::all();
        return view('menu.crudmenu', [
            'categories' => Category::all(),
            'menus' => $menus
        ]);
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'desc' => 'required|string',
            'harga' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        try {
            // Simpan gambar
            $imagePath = $request->file('image')->store('images', 'public');

            // Simpan data ke database
            Menu::create([
                'category_id' => $request->input('category'),
                'name' => $request->input('name'),
                'desc_produk' => $request->input('desc'),
                'img' => $imagePath,
                'stock' => $request->input('stock'),
                'price' => $request->input('harga'),
            ]);

            // Simpan pesan sukses ke dalam sesi flash
            Session::flash('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Simpan pesan kesalahan ke dalam sesi flash
            Session::flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        // Redirect kembali ke halaman sebelumnya
        return redirect()->back();
    }

    public function index()
    {
        $categories = Category::all();
        $menus = Menu::all(); // Mengambil data menu dengan relasi kategori
        return view('menu.crudmenu', compact('categories', 'menus'));
    }
    public function indexuser()
    {
        $tableId = session('table_id');
        $table = Table::findOrFail($tableId);
        $categories = Category::all();
        $menus = Menu::all(); // Mengambil data menu dengan relasi kategori
        return view('rest.vmenu', [
            'categories' => $categories,
             'menus' => $menus
            ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'desc' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $menu = Menu::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete the old image
            Storage::delete($menu->img);
            // Store the new image
            $imagePath = $request->file('image')->store('images', 'public');
            $menu->img = $imagePath;
        }

        $menu->update([
            'name' => $request->name,
            'category_id' => $request->category,
            'desc_produk' => $request->desc,
            'price' => $request->harga,
            'stock' => $request->stock,
        ]);

        return redirect()->route('menu.crudmenu')->with('success', 'Menu item updated successfully!');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        Storage::delete($menu->img);
        $menu->delete();

        return redirect()->route('menu.crudmenu')->with('success', 'Menu item deleted successfully!');
    }


    // view user
    // public function viewmenu(){
    //     return view('rest.vmenu',[
    //         'categories' => Category::all()
    //     ]);
    // }

    //view detail menu
    public function viewdetail(){
        return view('rest.detail',[
            'categories'=>Category::all()
        ]);
    }
}

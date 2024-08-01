<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function create() {
        return view('crud.create', [
            'categories' => Category::all()
        ]);
    }
    
    public function store(Request $request) {
        Menu::create([
            'category_id' => $request->category,
            'name' => $request->name,
            'desc_produk' => $request->desc,
            'img' => 'asdas',
            'stock' => $request->stock,
            'price' => $request->harga
        ]);
        
        return back();
    }
}

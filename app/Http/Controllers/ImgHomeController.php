<?php

namespace App\Http\Controllers;

use App\Models\ImgHome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ImgHomeController extends Controller
{
    public function create()
    {
        $imghomes = ImgHome::all();

        return view('imghome.crudimghome',[
            'imghomes'=> $imghomes,
        ]);
    }
    
    public function index()
    {
        // Panggil Semua data Imghome
        $imghomes = ImgHome::all();
        
        return view('imghome.crudimghome', compact('imghomes'));
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            // Simpan gambar
            $imagePath = $request->file('image')->store('imghome', 'public');

            // Simpan data ke database
            ImgHome::create([
                'name' => $request->input('name'),
                'imghome' => $imagePath,
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imghome = ImgHome::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($imghome->imghome) {
                Storage::disk('public')->delete($imghome->imghome);
            }

            // Store new image and update path in database
            $imghome->imghome = $request->file('image')->store('imghome', 'public');
        }

        // Update name if provided
        if ($request->filled('name')) {
            $imghome->name = $request->input('name');
        }

        $imghome->save();

        return redirect()->route('imghome.crudimghome')->with('success', 'Image updated successfully!');
    }


    public function destroy($id)
    {
        $imghome = ImgHome::findOrFail($id);

        // Delete image file from storage
        if ($imghome->imghome) {
            Storage::disk('public')->delete($imghome->imghome);
        }

        // Delete record from database
        $imghome->delete();

        return redirect()->route('imghome.crudimghome')->with('success', 'Image deleted successfully!');
    }

    public function ImgHomeUser(){
        $imghomes = ImgHome::all();

        return view('rest.index' ,[
            'imghomes' => $imghomes
        ]);
    }
    public function Home()
    {
        // Panggil Semua data Imghome
        $imghomes = ImgHome::all();
        
        return view('rest.index', compact('imghomes'));
    }

}

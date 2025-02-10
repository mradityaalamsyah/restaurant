<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Table;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class TableController extends Controller
{
    public function create()
    {
        return view('table.crudtable', [
            'tables' => Table::all()
        ]);
    }
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        // Buat data meja baru
        $table = new Table();
        $table->name = $request->name;
        $table->save();

        // Generate URL unik untuk QR Code
        $url = route('scan', ['id' => $table->id]); // Pastikan route 'scan' sudah ada

        // Generate QR Code menggunakan URL tersebut
        $qrCode = QrCode::size(250)->generate($url);

        // Simpan URL QR Code ke kolom 'qr' di tabel 'tables'
        $table->qr = $url;
        $table->save();

        return redirect()->back()->with('success', 'Meja berhasil ditambahkan dan QR Code dihasilkan.');
    }

    public function scan($id)
    {
        // Simpan table_id ke session
        session(['table_id' => $id]);

        // Dapatkan informasi meja berdasarkan ID
        $table = Table::findOrFail($id);
        $categories = Category::all();
        $menus = Menu::all();

        return view('rest.vmenu', compact('table', 'categories', 'menus'));
    }


    public function index()
    {
        // Mendapatkan semua data meja dari database
        $tables = Table::all(); // Definisikan variabel $tables

        // Kirim variabel $tables ke view
        return view('table.crudtable', compact('tables'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $table = Table::findOrFail($id);
            $table->name = $request->name;
            $table->save();

            return redirect()->back()->with('success', 'Data berhasil diupdate.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data.');
        }
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        try {
            $table = Table::findOrFail($id);
            $table->delete();

            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}

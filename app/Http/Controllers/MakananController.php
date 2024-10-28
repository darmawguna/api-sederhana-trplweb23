<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Makanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MakananController extends Controller
{
    // Menampilkan semua data makanan
    public function index()
    {
        $makanan = Makanan::all();
        return new PostResource(true, 'Data Makanan Berhasil Didapatkan!', $makanan);
    }

    // Menyimpan data makanan baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'price' => 'required|integer',
            'desc' => 'required|string|max:500',
            'category' => 'required|string|max:255',
            'stok' => 'required|integer',
            'foto_makanan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sku' => 'required|string|max:50|unique:makanans',
        ]);

        // Handle upload foto makanan jika ada
        if ($request->hasFile('foto_makanan')) {
            $path = $request->file('foto_makanan')->store('makanan_images', 'public');
            $validatedData['foto_makanan'] = $path;
        }

        $makanan = Makanan::create($validatedData);

        // return response()->json($makanan, 201);
        return new PostResource(true, 'Data Makanan Berhasil Ditambahkan!', $makanan);
    }

    // Menampilkan detail makanan berdasarkan ID
    public function show($id)
    {
        $makanan = Makanan::findOrFail($id);

        return response()->json($makanan, 200);
    }

    // Mengupdate data makanan berdasarkan ID
    public function update(Request $request, $id)
    {
        $makanan = Makanan::findOrFail($id);

        $validatedData = $request->validate([
            'nama_makanan' => 'required|string|max:255',
            'price' => 'required|integer',
            'desc' => 'required|string|max:500',
            'category' => 'required|string|max:255',
            'stok' => 'required|integer',
            'foto_makanan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sku' => 'required|string|max:50|unique:makanans,sku,' . $id,
        ]);

        // Handle upload foto makanan jika ada
        if ($request->hasFile('foto_makanan')) {
            // Hapus gambar lama jika ada
            if ($makanan->foto_makanan) {
                Storage::disk('public')->delete($makanan->foto_makanan);
            }

            $path = $request->file('foto_makanan')->store('makanan_images', 'public');
            $validatedData['foto_makanan'] = $path;
        }

        $makanan->update($validatedData);

        // Menggunakan PostResource untuk merespons
        return new PostResource(true, 'Data Makanan Berhasil Diperbarui!', $makanan);
    }


    // Menghapus data makanan berdasarkan ID
    public function destroy($id)
    {
        $makanan = Makanan::findOrFail($id);

        // Hapus gambar jika ada
        if ($makanan->foto_makanan) {
            Storage::disk('public')->delete($makanan->foto_makanan);
        }

        $makanan->delete();

        return response()->json(['message' => 'Makanan deleted successfully'], 200);
    }
}

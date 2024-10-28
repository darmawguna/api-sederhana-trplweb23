<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Kost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;

class KostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kosts = Kost::all();

        //return collection of posts as a resource
        // return new PostResource(true, 'List Data Posts', $posts);
        return response()->json(new PostResource(true, 'Data fetched successfully', $kosts));
    }

    // Menyimpan data kost baru
    public function store(Request $request)
    {
        // Definisikan aturan validasi
        $rules = [
            'harga' => 'required|string|max:255',
            'nama_kost' => 'required|string|max:255',
            'fasilitas' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jenis_kost' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:255',
            'no_wa' => 'required|string|max:255',
            'komentar' => 'nullable|string',
            'username' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Lakukan validasi
        $validator = Validator::make($request->all(), $rules);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Handle upload gambar jika ada
        $validatedData = $validator->validated(); // Ambil data yang sudah divalidasi

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('kost_images', 'public');
            $validatedData['foto'] = $path;
        }

        // Buat data kost baru
        $kost = Kost::create($validatedData);

        // Kembalikan response menggunakan resource dengan pesan sukses
        return new PostResource(true, 'Data Kost Berhasil Ditambahkan!', $kost);
    }



    // Menampilkan detail kost berdasarkan ID
    public function show($id)
    {
        $kost = Kost::find($id);

        //return single post as a resource
        return new PostResource(true, 'Detail Data Post!', $kost);
    }



    public function update(Request $request, $id)
    {
        // Definisikan aturan validasi
        $rules = [
            'harga' => 'required|string|max:255',
            'nama_kost' => 'required|string|max:255',
            'fasilitas' => 'required|string',
            'alamat' => 'required|string',
            'jenis_kost' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:255',
            'no_wa' => 'required|string|max:255',
            'komentar' => 'nullable|string',
            'username' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Lakukan validasi
        $validator = Validator::make($request->all(), $rules);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Temukan kost berdasarkan ID
        $kost = Kost::findOrFail($id);

        // Jika ada file foto yang diupload, simpan dan perbarui path-nya
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($kost->foto) {
                Storage::delete($kost->foto);
            }

            // Simpan foto baru dan ambil path-nya
            $path = $request->file('foto')->store('kost_images', 'public');
            $validatedData['foto'] = $path;
        }

        // Perbarui atribut kost
        $kost->update($validator->validated());

        // Kembalikan response
        return response()->json([
            'message' => 'Kost updated successfully!',
            'data' => $kost
        ]);
    }





    // Menghapus data kost berdasarkan ID
    public function destroy($id)
    {
        $kost = Kost::findOrFail($id);

        // Hapus gambar jika ada
        if ($kost->foto) {
            Storage::disk('public')->delete($kost->foto);
        }

        $kost->delete();

        // Kembalikan response JSON dengan pesan sukses
        return new PostResource(true, 'Data Kost Berhasil Dihapus!', null);
    }


}

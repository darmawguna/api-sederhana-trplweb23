<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Jeep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JeepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jeeps = Jeep::all();

        // Return collection of jeeps as a resource
        return response()->json(new PostResource(true, 'Data fetched successfully', $jeeps));
    }

    // Menyimpan data jeep baru
    public function store(Request $request)
    {
        // Definisikan aturan validasi
        $rules = [
            'id_pengguna' => 'required|string|max:255',
            'nama_pengguna' => 'required|string|max:255',
            'notelp_pengguna' => 'required|string|max:255',
            'alamat_pengguna' => 'required|string|max:255',
            'email_pengguna' => 'required|email|max:255',
            'password_pengguna' => 'required|string|max:255',
            'id_driver' => 'required|string|max:255',
            'nama_driver' => 'required|string|max:255',
            'notelp_driver' => 'required|string|max:255',
            'email_driver' => 'required|email|max:255',
            'password_driver' => 'required|string|max:255',
            'id_admin' => 'required|string|max:255',
            'nama_admin' => 'required|string|max:255',
            'password_admin' => 'required|string|max:255',
            'id_transaksi' => 'required|string|max:255',
            'tgl_pemesanan' => 'required|date',
            'status_pemesanan' => 'required|in:pending,proses,selesai,batal',
        ];

        // Lakukan validasi
        $validator = Validator::make($request->all(), $rules);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Buat data jeep baru
        $jeep = Jeep::create($validator->validated());

        // Kembalikan response menggunakan resource dengan pesan sukses
        return new PostResource(true, 'Data Jeep Berhasil Ditambahkan!', $jeep);
    }

    // Menampilkan detail jeep berdasarkan ID
    public function show($id)
    {
        $jeep = Jeep::findOrFail($id);

        // Return single jeep as a resource
        return new PostResource(true, 'Detail Data Jeep!', $jeep);
    }

    // Mengupdate data jeep berdasarkan ID
    public function update(Request $request, $id)
    {
        // Definisikan aturan validasi
        $rules = [
            'id_pengguna' => 'required|string|max:255',
            'nama_pengguna' => 'required|string|max:255',
            'notelp_pengguna' => 'required|string|max:255',
            'alamat_pengguna' => 'required|string|max:255',
            'email_pengguna' => 'required|email|max:255',
            'password_pengguna' => 'required|string|max:255',
            'id_driver' => 'required|string|max:255',
            'nama_driver' => 'required|string|max:255',
            'notelp_driver' => 'required|string|max:255',
            'email_driver' => 'required|email|max:255',
            'password_driver' => 'required|string|max:255',
            'id_admin' => 'required|string|max:255',
            'nama_admin' => 'required|string|max:255',
            'password_admin' => 'required|string|max:255',
            'id_transaksi' => 'required|string|max:255',
            'tgl_pemesanan' => 'required|date',
            'status_pemesanan' => 'required|in:pending,proses,selesai,batal',
        ];

        // Lakukan validasi
        $validator = Validator::make($request->all(), $rules);

        // Cek jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Temukan jeep berdasarkan ID
        $jeep = Jeep::findOrFail($id);

        // Perbarui atribut jeep
        $jeep->update($validator->validated());

        // Kembalikan response
        return new PostResource(true, 'Data Jeep Berhasil Diperbarui!', $jeep);
    }

    // Menghapus data jeep berdasarkan ID
    public function destroy($id)
    {
        $jeep = Jeep::findOrFail($id);
        $jeep->delete();

        // Kembalikan response JSON dengan pesan sukses
        return new PostResource(true, 'Data Jeep Berhasil Dihapus!', null);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import Hash untuk mengenkripsi kata sandi baru
use App\Models\Apoteker; // Import model Apoteker
use App\Models\Penjualan; // Import model Penjualan

class ApotekerController extends Controller
{
    // Metode untuk menampilkan halaman profil apoteker
    public function profile()
    {
        // Logika untuk menampilkan halaman profil apoteker
    }

    // Metode untuk memperbaharui jadwal operasional apotek
    public function updateSchedule(Request $request)
    {
        // Logika untuk memperbaharui jadwal operasional apotek
    }

    // Metode untuk menampilkan halaman form untuk mengubah kata sandi
    public function showUpdatePasswordForm()
    {
        return view('change_password');
    }

    // Metode untuk memproses permintaan perubahan kata sandi
    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Ambil data apoteker yang sedang aktif
        $apoteker = Apoteker::find(auth()->id());

        // Periksa apakah kata sandi saat ini cocok
        if (!Hash::check($request->current_password, $apoteker->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini salah.']);
        }

        // Enkripsi dan simpan kata sandi baru
        $apoteker->password = Hash::make($request->new_password);
        $apoteker->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('profile')->with('success', 'Kata sandi berhasil diperbarui.');
    }

    // Metode untuk menampilkan daftar obat yang telah terjual
    public function soldMedicines()
    {
        // Ambil semua data penjualan yang terjadi
        $penjualan = Penjualan::all();

        // Tampilkan view dengan data penjualan
        return view('sold_medicines', compact('penjualan'));
    }

    // Metode untuk memperbarui waktu operasional apoteker
    public function updateOperationalHours(Request $request)
    {
        // Validasi input
        $request->validate([
            'waktuOperasi' => 'required|string', // Ubah aturan validasi sesuai dengan tipe data VARCHAR
        ]);

        // Perbarui waktu operasional pada data apoteker yang sedang aktif
        $apoteker = Apoteker::find(auth()->id()); // Menggunakan metode otentikasi yang sesuai
        $apoteker->waktuOperasi = $request->waktuOperasi;
        $apoteker->save();

        return redirect()->back()->with('success', 'Waktu operasional berhasil diperbarui.');
    }
}

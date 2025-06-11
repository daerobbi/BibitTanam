<?php

namespace App\Http\Controllers\mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Agen;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class c_akunagen extends Controller
{
    public function tampilProfil()
    {
        $idAkun = Auth::id();

        $agen = Agen::with('user')->where('id_akun', $idAkun)->first();

        if (!$agen) {
            abort(404, 'Data agen tidak ditemukan.');
        }

        return view('Mitra.v_akunagen', compact('agen'));
    }

    public function edit()
    {
        $agen = agen::with('user')->where('id_akun', Auth::id())->first();
        return view('mitra.v_editakunagen', compact('agen'));
    }

    public function update(Request $request)
{
    // Validasi input utama
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string',
        'no_hp' => 'required|string|max:20',
        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        'foto_profil' => 'nullable|image',
    ]);

    $agen = agen::where('id_akun', Auth::id())->firstOrFail();
    $user = $agen->user;

    // ===== CEK UBAH PASSWORD OPSIONAL =====
    if ($request->filled('password_lama') || $request->filled('password_baru') || $request->filled('konfirmasi_password')) {

        // Validasi form password
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8',
            'konfirmasi_password' => 'required|same:password_baru',
        ]);

        // Cek apakah password lama benar
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama salah.'])->withInput();
        }

        // Jika benar, update password baru
        $user->password = Hash::make($request->password_baru);
    }

    // Update data agen
    $agen->nama = $request->nama;
    $agen->alamat = $request->alamat;
    $agen->no_hp = $request->no_hp;

    // Update email user
    $user->email = $request->email;

    // Handle file upload foto_profil
    if ($request->hasFile('foto_profil')) {
        // Hapus file lama jika ada
        if ($agen->foto_profil && Storage::disk('public')->exists($agen->foto_profil)) {
            Storage::disk('public')->delete($agen->foto_profil);
        }

        // Simpan file baru ke storage
        $path = $request->file('foto_profil')->store('foto_profil', 'public');
        $agen->foto_profil = $path;
    }

    // Simpan perubahan
    $agen->save();
    $user->save();

    return redirect()->route('agen.profil')->with('success', 'Profil berhasil diperbarui!');
}

}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\agen;
use App\Models\rekan_tani;
use App\Models\kota;

class c_register extends Controller
{
    public function showForm()
    {
        $kota = Kota::all();
        return view('v_register', compact('kota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kota' => 'required|exists:kotas,id',
            'whatsapp' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'daftar' => 'required|in:rekantani,agen',
            'dokumen_verifikasi' => 'required|file|mimes:pdf',
        ]);

        // Upload dokumen
        $path = $request->file('dokumen_verifikasi')->store('bukti_usaha', 'public');

        // Simpan ke tabel akun
        $akun = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->daftar,
            'status_akun' => null,
        ]);

        // Simpan ke akun_rekan atau akun_agen
        if ($request->daftar === 'rekantani') {
            rekan_tani::create([
                'id_akun' => $akun->id,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->whatsapp,
                'bukti_usaha' => $path,
                'id_kota' => $request->kota,
            ]);
        } else {
            agen::create([
                'id_akun' => $akun->id,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_hp' => $request->whatsapp,
                'bukti_usaha' => $path,
            ]);
        }

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan menunggu akun anda diverivikasi admin.');
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class c_berandaadmin extends Controller
{
    public function index()
    {
        // Rekan Tani aktif
        $jumlahRekanTani = User::where('role', 'rekantani')
                                ->where('status_akun', 1)
                                ->count();

        // Agen aktif
        $jumlahAgen = User::where('role', 'agen')
                            ->where('status_akun', 1)
                            ->count();

        // Akun yang menunggu verifikasi (misalnya status_verifikasi = 'pending')
        $jumlahPending = User::whereNull('status_akun')->count();

        return view('admin.v_beranda', [
            'jumlahRekanTani' => $jumlahRekanTani,
            'jumlahAgen' => $jumlahAgen,
            'jumlahPending' => $jumlahPending,
        ]);
    }
}

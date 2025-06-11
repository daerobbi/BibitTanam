<?php

namespace App\Http\Controllers\mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan;
use App\Models\Agen;

class c_berandaagen extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Ambil user yang login

        // Ambil data agen dari relasi akun ke akun_agen
        // Asumsikan foreign key dari akun_agen adalah id_akun yang merujuk ke akun.id
        $agen = Agen::where('id_akun', $user->id)->first(); // atau where('id_akun', $user->id) jika relasinya begitu

        $namaAgen = $agen ? $agen->nama : 'Agen';

        // Ambil ID agen (asumsinya ID sama dengan id_agens pada pengajuan)
        $idAgen = $agen->id ?? null;

        // Hitung total pengajuan oleh agen ini
        $totalPengajuan = Pengajuan::where('id_agens', $idAgen)->count();

        // Hitung pengajuan dengan status "menunggu"
        $menungguPersetujuan = Pengajuan::where('id_agens', $idAgen)
            ->whereNull('status_pengajuan')
            ->count();

        return view('mitra.v_beranda', compact(
            'namaAgen',
            'totalPengajuan',
            'menungguPersetujuan'
        ));
    }
}

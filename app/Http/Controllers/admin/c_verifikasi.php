<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class c_verifikasi extends Controller
{
    public function index(Request $request)
    {
        $role = $request->input('role');
        $status = $request->input('status');

        $users = User::with(['agen', 'rekantani'])
            ->whereIn('role', ['rekantani', 'agen'])
            ->where(function ($query) {
                $query->whereNull('status_akun')
                    ->orWhere('status_akun', 0);
            })
            ->when($role, fn($query) => $query->where('role', $role))
            ->when($status !== null, function ($query) use ($status) {
                if ($status === 'null') {
                    $query->whereNull('status_akun');
                } else {
                    $query->where('status_akun', $status);
                }
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $countReview = User::whereIn('role', ['rekantani', 'agen'])
            ->whereNull('status_akun')
            ->count();

        $countAccepted = User::whereIn('role', ['rekantani', 'agen'])
            ->where('status_akun', 1)
            ->count();

        $countRejected = User::whereIn('role', ['rekantani', 'agen'])
            ->where('status_akun', 0)
            ->count();

        return view('admin.v_verifikasiakun', compact(
            'users',
            'countReview',
            'countAccepted',
            'countRejected',
            'role',
            'status'
        ));
    }

    public function showdetail($id)
    {
        // Load user dan relasi kota secara eager
        $user = User::with(['agen', 'rekantani.kota'])->findOrFail($id);
        $role = $user->role;

        if ($role === 'rekantani') {
            $data = $user->rekantani;
            $kota = $data->kota->nama_kota ?? '-'; // relasi belongsTo ke tabel kota
            $nama = $data->nama ?? '-';
            $alamat = $data->alamat ?? '-';
            $no_wa = $data->no_hp ?? '-';
            $dokumen = $data->bukti_usaha ?? null;
        } elseif ($role === 'agen') {
            $data = $user->agen;
            $kota = $data->kota ?? '-'; // diasumsikan langsung string di kolom 'kota' tabel agen
            $nama = $data->nama ?? '-';
            $alamat = $data->alamat ?? '-';
            $no_wa = $data->no_hp ?? '-';
            $dokumen = $data->bukti_usaha ?? null;
        } else {
            abort(404); // jika role tidak valid
        }

        $tanggal_daftar = $user->created_at ? $user->created_at->format('d/m/y') : '-';

        return view('admin.v_detailverfikasi', compact(
            'user',
            'role',
            'nama',
            'kota',
            'alamat',
            'no_wa',
            'dokumen',
            'tanggal_daftar'
        ));
    }

    public function verifikasi($id)
    {
        $user = User::findOrFail($id);
        $user->status_akun = 1;
        $user->save();

        return redirect()->route('admin.verifikasi')->with('success', 'Akun berhasil diverifikasi.');
    }

    public function tolak($id)
    {
        $user = User::findOrFail($id);
        $user->status_akun = 0;
        $user->save();

        return redirect()->route('admin.verifikasi')->with('success', 'Akun berhasil ditolak.');
    }
}

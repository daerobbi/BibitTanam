<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rekan_tani;
use App\Models\kota;

class c_rekantani extends Controller
{
    public function rekantani(Request $request)
    {
        // Query Rekan Tani terverifikasi dan dengan role "rekan tani"
        $query = rekan_tani::with(['user', 'kota'])
            ->whereHas('user', function ($q) {
                $q->where('status_akun',1)
                    ->where('role', 'rekantani');
            });

        // Filter berdasarkan nama
        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }

        // Filter berdasarkan kota
        if ($request->filled('lokasi')) {
            $query->whereHas('kota', function ($q) use ($request) {
                $q->where('nama_kota', $request->lokasi);
            });
        }

        $rekans = $query->get();
        $kotaList = kota::pluck('nama_kota');

        return view('admin.v_rekantani', compact('rekans', 'kotaList'));
    }

    public function detail($id)
    {
        $rekantani = rekan_tani::with(['user', 'kota'])->findOrFail($id);
        return view('admin.v_detailakunrekantani', compact('rekantani'));
    }
}

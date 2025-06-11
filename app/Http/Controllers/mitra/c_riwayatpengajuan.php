<?php

namespace App\Http\Controllers\mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class c_riwayatpengajuan extends Controller
{
    public function riwayatPengajuan(Request $request)
    {
        $user = Auth::user();
        $agen = $user->agen;

        $pengajuan = Pengajuan::with(['bibit.rekanTani'])
        ->where('id_agens', $agen->id)
        ->where(function ($query) {
            $query->where('status_pengajuan', 0)
                ->orWhere('status_pembayaran', 1);
    });


        // Filter berdasarkan nama bibit atau nama rekan jika ada parameter pencarian
        if ($request->cari) {
            $pengajuan->whereHas('bibit', function($q) use ($request) {
                $q->where('nama_bibit', 'like', '%' . $request->cari . '%')
                    ->orWhereHas('rekanTani', function($q2) use ($request) {
                        $q2->where('nama', 'like', '%' . $request->cari . '%');
                    });
            });
        }

        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'ditolak') {
                $pengajuan->where('status_pengajuan', 0);
            }
            elseif ($request->status == 'diproses') {
                $pengajuan->where('status_pembayaran', 1)
                        ->where('status_pengiriman', 'diproses');
            }
                else {
                $pengajuan->where('status_pengiriman', $request->status);
            }
        }

        $pengajuan = $pengajuan->orderBy('created_at', 'desc')->get();

        return view('Mitra.v_riwayatPengajuan', compact('pengajuan'));
    }

    public function terima($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status_pengiriman = 'selesai';
        $pengajuan->save();

        return redirect()->back()->with('success', 'Bibit sudah diterima.');
    }

    public function detailriwayat($id){
        $pengajuan = Pengajuan::with(['agen', 'bibit.rekanTani'])->findOrFail($id);
        return view('Mitra.v_detailriwayat', compact('pengajuan'));
    }

}

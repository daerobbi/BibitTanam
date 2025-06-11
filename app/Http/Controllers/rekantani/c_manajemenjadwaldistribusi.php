<?php

namespace App\Http\Controllers\rekantani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class c_manajemenjadwaldistribusi extends Controller
{
    public function terverifikasi(Request $request)
    {
        $rekanTani = Auth::user()->rekantani;

        $query = Pengajuan::with(['bibit', 'agen'])
            ->where('status_pembayaran', 1)
            ->whereHas('bibit', function ($q) use ($rekanTani) {
                $q->where('id_rekantani', $rekanTani->id);
            });

        // Pencarian berdasarkan nama agen
        if ($request->has('search') && !empty($request->search)) {
            $query->whereHas('agen', function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        // Filter berdasarkan status distribusi bibit
        if ($request->has('status_pengiriman') && !empty($request->status_pengiriman)) {
            $query->where('status_pengiriman', $request->status_pengiriman);
        }

        $pengajuan = $query->get();

        return view('rekantani.v_manajemenjadwaldistribusi', compact('pengajuan'));
    }

    public function showdetailpengiriman($id)
    {
        $pengajuan = Pengajuan::with(['bibit.jenisBibit', 'bibit.rekanTani'])->findOrFail($id);
        $tanggalDibutuhkan = Carbon::parse($pengajuan->tanggal_dibutuhkan);
        $tanggalPengiriman = Carbon::parse($pengajuan->tanggal_pengiriman);
        $akunRekan = $pengajuan->bibit->rekanTani ?? null;

        return view('rekantani.v_detailpengiriman', compact('pengajuan', 'akunRekan','tanggalDibutuhkan', 'tanggalPengiriman'));
    }

    public function updateStatusPengiriman($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status_pengiriman = 'dikirim';
        $pengajuan->tanggal_pengiriman = Carbon::now();
        $pengajuan->save();

        return redirect()->route('rekantani.distribusi')->with('success', 'Status pengiriman berhasil diubah!');
    }

    public function riwayatpengajuan(Request $request)
    {
        $user = Auth::user();
        $rekanTani = $user->rekantani;

        $pengajuan = Pengajuan::with(['agen', 'bibit'])
            ->whereHas('bibit', function ($query) use ($rekanTani) {
                $query->where('id_rekantani', $rekanTani->id);
            })
            ->where(function ($query) {
                $query->where('status_pengajuan', 0)
                    ->orWhere('status_pengiriman', 'selesai');
            });

        // Filter berdasarkan nama agen atau nama bibit
        if ($request->cari) {
            $pengajuan->where(function ($q) use ($request) {
                $q->whereHas('agen', function ($q1) use ($request) {
                    $q1->where('nama', 'like', '%' . $request->cari . '%');
                })
                ->orWhereHas('bibit', function ($q2) use ($request) {
                    $q2->where('nama_bibit', 'like', '%' . $request->cari . '%');
                });
            });
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'ditolak') {
                $pengajuan->where('status_pengajuan', 0);
            } else {
                $pengajuan->where('status_pengiriman', $request->status);
            }
        }

        $pengajuan = $pengajuan->orderBy('created_at', 'desc')->get();

        return view('rekantani.v_riwayatpengajuan', compact('pengajuan'));
    }

    public function detailriwayat($id)
    {
        $rekanTani = Auth::user()->rekantani;
        $pengajuan = Pengajuan::with(['agen', 'bibit.rekanTani'])
            ->whereHas('bibit', function ($query) use ($rekanTani) {
                $query->where('id_rekantani', $rekanTani->id);
            })
            ->findOrFail($id);

        return view('rekantani.v_detailriwayatpengajuan', compact('pengajuan'));
    }
}

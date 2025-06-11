<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;

class c_pengajuanadmin extends Controller
{
    public function index(Request $request)
    {
        // Ambil relasi agen, bibit, dan dari bibit → rekan_tani
        $query = Pengajuan::with(['agen', 'bibit.rekanTani'])
            ->whereIn('status_pengajuan', [0, 1]);


        // Filter bulan (format: 01, 02, dst.)
        if ($request->bulan) {
            $query->whereMonth('created_at', $request->bulan);
        }

        // Filter status
        if ($request->has('status') && $request->status !== 'Semua Pengajuan') {
            $query->where('status_pengajuan', $request->status == '1' ? true : false);
        }


        // Search by nama agen atau rekan tani (lewat bibit → rekan_tani)
        if ($request->search) {
            $query->whereHas('agen', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            })->orWhereHas('bibit.rekanTani', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        $pengajuan = $query->orderBy('created_at', 'desc')->get();

        return view('admin.v_pengajuan', compact('pengajuan'));
    }

    public function detailpengajuan($id)
    {
        $pengajuan = Pengajuan::with(['agen', 'bibit.rekanTani'])->findOrFail($id);
        return view('admin.v_detailpengajuan', compact('pengajuan'));
    }
}

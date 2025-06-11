<?php

namespace App\Http\Controllers\rekantani;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class C_pengajuanrekan extends Controller
{
    public function tampilpengajuan()
    {
        $rekanTani = Auth::user()->rekantani;

        $pengajuan = Pengajuan::whereHas('bibit', function($query) use ($rekanTani) {
            $query->where('id_rekantani', $rekanTani->id);
        })
        ->with(['bibit', 'agen'])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('rekantani.v_pengajuan', compact('pengajuan'));
    }


    public function lihatdetailpengajuan($id)
    {
        $pengajuan = Pengajuan::with(['bibit.rekanTani', 'bibit.jenisBibit'])->findOrFail($id);
        return view('rekantani.v_detailpengajuan', compact('pengajuan'));
    }


    public function terimaPengajuan(Request $request, $id)
    {
        $request->validate([
            'foto_invoice' => 'required|mimes:png,jpg,jpeg',
        ]);
        $pengajuan = Pengajuan::findOrFail($id);

        if ($request->hasFile('foto_invoice')) {
            $file = $request->file('foto_invoice');
            $fileName = 'invoice_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('invoices', $fileName, 'public');

            $pengajuan->foto_invoice = $filePath;
        }

        $pengajuan->status_pengajuan = 1;
        $pengajuan->save();

        return redirect()->route('rekantani.pengajuanmasuk', $id)->with('success', 'Pengajuan telah diterima dan invoice berhasil di upload.');
    }


    public function tolakPengajuan($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $bibit = $pengajuan->bibit;
        $bibit->stok += $pengajuan->jumlah_permintaan;
        $bibit->save();

        $pengajuan->status_pengajuan = 0;
        $pengajuan->save();

        return redirect()->route('rekantani.pengajuanmasuk', $id)->with('error', 'Pengajuan telah ditolak dan stok bibit dikembalikan.');
    }

    public function pembayaran($id)
    {
        $pengajuan = Pengajuan::with('agen')->findOrFail($id);
        return view('rekantani.v_verifikasipembayaran', compact('pengajuan'));
    }

    public function verifikasi($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $pengajuan->status_pembayaran = 1;
        $pengajuan->save();

        return redirect()->route('rekantani.pengajuanmasuk', $id)->with('success', 'Pembayaran telah diverifikasi.');
    }

    public function tolak($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);

        $bibit = $pengajuan->bibit;
        $bibit->stok += $pengajuan->jumlah_permintaan;
        $bibit->save();

        // Update status
        $pengajuan->status_pembayaran = 0;
        $pengajuan->status_pengajuan = 0;
        $pengajuan->save();

        return redirect()->route('rekantani.pengajuanmasuk', $id)->with('error', 'Pembayaran telah ditolak dan stok bibit dikembalikan.');
    }
}

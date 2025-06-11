<?php

namespace App\Http\Controllers\mitra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rekan_tani;
use App\Models\JenisBibit;
use App\Models\kota;
use App\Models\bibit;
use App\Models\pengajuan;
use Illuminate\Support\Facades\Auth;

class C_pengajuanAgen extends Controller
{
    public function lihatprofil($rekantani_id)
    {
        $rekan = rekan_tani::with('kota')->where('id', $rekantani_id)->firstOrFail();

        $bibits = $rekan->bibit()->with('JenisBibit')->get();

        return view('Mitra.v_katalog', compact('rekan', 'bibits'));
    }


    public function detailkatalog($bibit_id)
    {
        $bibit = bibit::with(['JenisBibit', 'rekanTani.kota'])->findOrFail($bibit_id);

        return view('Mitra.v_detailkatalog', compact('bibit'));
    }


    public function formpengajuan($bibitId)
    {
        $bibit = bibit::findOrFail($bibitId);
        return view('Mitra.v_formpengajuan', compact('bibit'));
    }


    public function submitPengajuan(Request $request, $bibit_id)
        {
            $request->validate([
                'jumlah_permintaan' => 'required|integer|min:1',
                'tanggal_dibutuhkan' => 'required|date',
                'tanggal_pengiriman' => 'nullable|date',
                'lokasi_pengiriman' => 'required|string',
                'keterangan' => 'nullable|string',
                'narahubung' => 'required|string',
            ]);

            $bibit = Bibit::findOrFail($bibit_id);
            $agen = auth()->user()->agen;

            // Cek apakah stok cukup
            if ($bibit->stok < $request->jumlah_permintaan) {
                return redirect()->back()->with('error', 'Stok bibit tidak mencukupi.');
            }

            // Kurangi stok
            $bibit->stok -= $request->jumlah_permintaan;
            $bibit->save();

            Pengajuan::create([
                'jumlah_permintaan' => $request->jumlah_permintaan,
                'tanggal_dibutuhkan' => $request->tanggal_dibutuhkan,
                'tanggal_pengiriman' => $request->tanggal_pengiriman,
                'lokasi_pengiriman' => $request->lokasi_pengiriman,
                'keterangan' => $request->keterangan,
                'narahubung' => $request->narahubung,
                'status_pengajuan' => null,
                'status_pembayaran' => null,
                'status_pengiriman' => 'diproses',
                'foto_invoice' => null,
                'bukti_bayar' => null,
                'id_bibit' => $bibit->id,
                'id_agens' => $agen->id,
            ]);

            return redirect()->route('agen.katalog', ['rekantani_id' => $bibit->rekanTani->id])->with('success', 'Pengajuan berhasil dikirim!');
        }



        public function pengajuanterbaru()
        {
            $user = Auth::user();
            $agen = $user->agen;

            if (!$agen) {
                abort(403, 'Agen tidak ditemukan atau belum diverifikasi.');
            }

            $pengajuan = Pengajuan::with(['bibit.rekanTani'])
                ->where('id_agens', $agen->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('Mitra.v_pengajuanterbaru', compact('pengajuan'));
        }


        public function detailpengajuan($pengajuan_id)
        {
            $pengajuan = Pengajuan::with('bibit.rekanTani')->findOrFail($pengajuan_id);
            return view('Mitra.v_detailpengajuan', compact('pengajuan'));
        }

        public function updatePengajuan(Request $request, $pengajuan_id)
        {
            $request->validate([
                'jumlah_permintaan' => 'required|integer|min:1',
                'tanggal_dibutuhkan' => 'required|date',
                'tanggal_pengiriman' => 'nullable|date',
                'lokasi_pengiriman' => 'required|string',
                'keterangan' => 'nullable|string',
                'narahubung' => 'required|string',
            ]);

            $pengajuan = Pengajuan::findOrFail($pengajuan_id);
            $bibit = $pengajuan->bibit;

            $jumlahLama = $pengajuan->jumlah_permintaan;
            $jumlahBaru = $request->jumlah_permintaan;

            if ($jumlahBaru > $jumlahLama) {
                // Cek stok untuk tambahan
                $selisih = $jumlahBaru - $jumlahLama;
                if ($bibit->stok < $selisih) {
                    return redirect()->back()->with('error', 'Stok bibit tidak mencukupi untuk pembaruan.');
                }
                // Kurangi stok sesuai tambahan
                $bibit->stok -= $selisih;
            } elseif ($jumlahBaru < $jumlahLama) {
                // Tambahkan stok kembali karena jumlah dikurangi
                $selisih = $jumlahLama - $jumlahBaru;
                $bibit->stok += $selisih;
            }
            // Simpan perubahan stok bibit
            $bibit->save();

            // Update pengajuan
            $pengajuan->update([
                'jumlah_permintaan' => $jumlahBaru,
                'tanggal_dibutuhkan' => $request->tanggal_dibutuhkan,
                'tanggal_pengiriman' => $request->tanggal_pengiriman,
                'lokasi_pengiriman' => $request->lokasi_pengiriman,
                'keterangan' => $request->keterangan,
                'narahubung' => $request->narahubung,
            ]);

            return redirect()->route('v_pengajuanterbaru')
                ->with('success', 'Data pengajuan berhasil diubah.');
        }

        public function detailpembayaran($pengajuan_id)
        {
            $pengajuan = Pengajuan::with('bibit.rekanTani')->findOrFail($pengajuan_id);
            return view('Mitra.v_pembayaran', compact('pengajuan'));
        }
        public function uploadBuktiTransfer(Request $request, $pengajuan_id)
        {
            $request->validate([
                'bukti_transfer' => 'required|mimes:png,jpg,jpeg',
            ]);

            $pengajuan = Pengajuan::findOrFail($pengajuan_id);
            $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

            // Update pengajuan
            $pengajuan->update([
                'bukti_bayar' => $path,
            ]);

            return redirect()->route('v_pengajuanterbaru')->with('success', 'Bukti transfer berhasil diunggah!');
        }

        public function hapusPengajuan($pengajuan_id)
        {
            $pengajuan = Pengajuan::findOrFail($pengajuan_id);
            $bibit = $pengajuan->bibit;
            $bibit->stok += $pengajuan->jumlah_permintaan;
            $bibit->save();
            $pengajuan->delete();

            return redirect()->route('v_pengajuanterbaru')
                ->with('success', 'Data pengajuan berhasil dihapus.');
        }

    public function tampilRekanTani(Request $request)
    {
        $lokasi = $request->input('lokasi');
        $jenis = $request->input('jenis');

        $query = rekan_tani::with(['bibit.JenisBibit', 'kota', 'user'])
            ->whereHas('user', function ($q) {
                $q->where('status_akun', 1);
            });

        if ($lokasi) {
            $query->whereHas('kota', function ($q) use ($lokasi) {
                $q->where('nama_kota', $lokasi);
            });
        }

        if ($jenis) {
            $query->whereHas('bibit.JenisBibit', function ($q) use ($jenis) {
                $q->where('jenis_bibit', 'like', '%' . $jenis . '%');
            });
        }

        $rekanTani = $query->get();
        $daftarJenis = JenisBibit::all();
        $daftarKota = Kota::all();

        return view('Mitra.v_pengajuan', compact('rekanTani', 'daftarJenis', 'daftarKota'));
    }
}



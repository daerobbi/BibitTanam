<?php

namespace App\Http\Controllers\rekantani;
use App\Http\Controllers\Controller;
use App\Models\bibit;
use App\Models\JenisBibit;
use App\Models\rekan_tani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

class c_katalog extends Controller
{
    private function getIdRekanTani()
    {
        return rekan_tani::where('id_akun', Auth::user()->id)->value('id');
    }

    public function detailkatalog($id)
    {
        $detailKatalog = bibit::with('jenisBibit')->findOrFail($id);
        $detailKatalog->harga = str_replace('IDR', 'Rp', Number::currency($detailKatalog->harga, 'IDR'));
        return view('rekantani.v_detailkatalogrekan', compact('detailKatalog'));
    }

    public function tampiltambahkatalog()
    {
        $jenisBibitList = JenisBibit::all();
        return view('rekantani.v_tambahkatalog', compact('jenisBibitList'));
    }

    public function tambahkatalog(Request $request)
    {
    $request->validate([
        'jenis_bibit_id' => 'required|exists:jenis_bibits,id',
        'nama_bibit' => 'required|string|max:255',
        'stok' => 'required|integer|min:0',
        'harga' => 'required|integer|min:0',
        'deskripsi' => 'required|string',
        'foto_bibit' => 'required|mimes:png,jpg,jpeg',
    ]);

    $idUser = Auth::id();
    $rekanTani = rekan_tani::where('id_akun', $idUser)->first();

    if (!$rekanTani) {
        return back()->with('error', 'Akun ini bukan Rekan Tani.');
    }

    $gambarPath = $request->file('foto_bibit')->store('katalog', 'public');

    bibit::create([
        'nama_bibit' => $request->nama_bibit,
        'stok' => $request->stok,
        'harga' => $request->harga,
        'deskripsi' => $request->deskripsi,
        'foto_bibit' => $gambarPath,
        'id_rekantani' => $this->getIdRekanTani(),
        'id_jenisbibit' => $request->jenis_bibit_id,
    ]);

    return redirect()->route('rekantani.katalog')->with('success', 'Katalog berhasil ditambahkan!');
    }


    public function index(Request $request)
    {
        $idRekanTani = $this->getIdRekanTani();
        $query = $request->input('query');

        $bibits = bibit::with('jenisBibit')
            ->where('id_rekantani', $idRekanTani)
            ->when($query, function ($q) use ($query) {
                $q->where('nama_bibit', 'like', '%' . $query . '%');
            })
            ->get()
            ->map(function ($data) {
                $data->harga = str_replace('IDR', 'Rp', Number::currency($data->harga, 'IDR'));
                return $data;
            })
            ->groupBy('id_jenisbibit');

        return view('rekantani.v_katalogrekan', [
            'katalogs' => $bibits,
        ]);
    }

    public function delete($id)
    {
        $bibit = bibit::findOrFail($id);
        $bibit->delete();
        return redirect()->route('rekantani.katalog')->with('success', 'Katalog berhasil dihapus!');
    }

    public function editkatalog($id)
    {
        $bibit = bibit::findOrFail($id);
        $jenisBibitList = JenisBibit::all();
        return view('rekantani.v_editkatalogrekan', compact('bibit', 'jenisBibitList'));
    }

    public function updatekatalog(Request $request, $id)
    {
        $request->validate([
            'id_jenisbibit' => 'required|exists:jenis_bibits,id',
            'nama_bibit' => 'required|string|max:255',
            'stok' => 'required|integer|',
            'harga' => 'required|integer|',
            'deskripsi' => 'required|string',
        ]);

        $bibit = bibit::findOrFail($id);
        $bibit->id_jenisbibit = $request->id_jenisbibit;
        $bibit->nama_bibit = $request->nama_bibit;
        $bibit->stok = $request->stok;
        $bibit->harga = $request->harga;
        $bibit->deskripsi = $request->deskripsi;

        if ($request->hasFile('foto_bibit')) {
            if ($bibit->foto_bibit && Storage::disk('public')->exists($bibit->foto_bibit)) {
                Storage::disk('public')->delete($bibit->foto_bibit);
            }
            $gambarPath = $request->file('foto_bibit')->store('katalog', 'public');
            $bibit->foto_bibit = $gambarPath;
        }

        $bibit->save();

        return redirect()->route('rekantani.detailkatalog', ['id' => $bibit->id])->with('success', 'Katalog berhasil diperbarui!');

    }

    public function cariKatalog(Request $request)
    {
        $query = $request->input('query');
        $idRekanTani = $this->getIdRekanTani();

        $katalogs = bibit::with('jenisBibit')
            ->where('id_rekantani', $idRekanTani)
            ->where(function ($q) use ($query) {
                $q->where('nama_bibit', 'like', '%' . $query . '%')
                    ->orWhereHas('jenisBibit', function ($subQuery) use ($query) {
                        $subQuery->where('jenis_bibit', 'like', '%' . $query . '%');
                    });
            })
            ->get()
            ->map(function (bibit $item) {
                $item->harga = str_replace('IDR', 'Rp', Number::currency($item->harga, 'IDR'));
                return $item;
            })
            ->groupBy('id_jenisbibit');

        return view('rekantani.v_katalogrekan', compact('katalogs'));
    }
}

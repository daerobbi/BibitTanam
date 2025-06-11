@extends('Mitra.app')
@section('content')

<!-- Filter -->
<form method="GET" action="{{ route('v_pengajuan') }}">
    <div class="bg-yellow-400 p-4 w-full">
        <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-4">
            <div class="flex flex-wrap gap-1 items-center">
                <span class="font-semibold">Cari Rekan Tani Berdasarkan</span>


                <!-- Lokasi -->
                <div class="flex gap-2 items-center">
                    <label for="lokasi" class="font-medium">Lokasi :</label>
                    <select name="lokasi" id="lokasi" class="px-2 py-1 rounded">
                        <option value="">Semua</option>
                        @foreach($daftarKota as $kota)
                            <option value="{{ $kota->nama_kota }}" {{ request('lokasi') == $kota->nama_kota ? 'selected' : '' }}>
                                {{ $kota->nama_kota }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Jenis Bibit -->
                <div class="flex gap-2 items-center">
                    <label for="jenis" class="font-medium">Jenis Bibit :</label>
                    <select name="jenis" id="jenis" class="px-2 py-1 rounded">
                        <option value="">Semua</option>
                        @foreach($daftarJenis as $jenis)
                            <option value="{{ $jenis->jenis_bibit }}" {{ request('jenis') == $jenis->jenis_bibit ? 'selected' : '' }}>
                                {{ $jenis->jenis_bibit }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-green-700 text-white px-4 py-1 rounded hover:bg-green-800">Cari</button>
            </div>

            <div class="ml-auto">
                <a href="{{ route('v_pengajuanterbaru') }}" class="text-sm font-semibold text-green-900 hover:underline">Lihat Pengajuan terbaru &gt;</a>
            </div>
        </div>
    </div>
</form>

<!-- Daftar Rekan Tani -->
<div class="max-w-7xl mx-auto mt-8 bg-white p-6 rounded shadow mb-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Daftar Rekan Tani</h2>

    <!-- Card List -->
    <div class="divide-y divide-gray-300 border-t border-b">
        @forelse($rekanTani as $rekan)
            <div class="flex justify-between items-start py-4">
                <div>
                    <h3 class="font-bold text-lg">{{ $rekan->nama }}</h3>
                    <p>Lokasi : {{ $rekan->kota->nama_kota ?? '-' }}</p>
                    <p>Jenis Bibit :
                        {{ $rekan->bibit->pluck('JenisBibit.jenis_bibit')->unique()->implode(', ') }}
                    </p>
                </div>
                <a href="{{ route('agen.katalog', ['rekantani_id' => $rekan->id]) }}" class="text-green-700 font-semibold hover:underline text-sm mt-1 whitespace-nowrap">Lihat Profil &gt;</a>
            </div>
        @empty
            <p class="py-6 text-center text-gray-500">Tidak ada data Rekan Tani ditemukan.</p>
        @endforelse
    </div>
</div>
@endsection

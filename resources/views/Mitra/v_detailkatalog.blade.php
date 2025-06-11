@extends('Mitra.app')

@section('content')
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-1/4 h-screen sticky top-0 bg-gray-200 p-6 flex flex-col items-center shadow-md min-h-full">
        <img src="{{ asset('storage/' . ($bibit->rekanTani->foto_profil ?? '#')) }}"
                alt="Rekan Tani"
                class="rounded-full w-40 h-40 object-cover mb-4">
        <h2 class="text-xl font-bold mb-2">{{ $bibit->rekanTani->nama ?? 'Nama Petani' }}</h2>
        <p class="text-sm text-gray-600 mb-1">Lokasi : {{ $bibit->rekanTani->kota->nama_kota ?? '-' }}</p>
        <p class="text-sm text-gray-600 text-center mb-1">
            Jenis Bibit : {{ $bibit->JenisBibit->jenis_bibit ?? '-' }}
        </p>
        <p class="text-sm text-gray-600 text-center mb-1">Kontak : {{ $bibit->rekanTani->no_hp }}</p>
        <p class="text-sm text-gray-600 text-center mb-1">Alamat : {{ $bibit->rekanTani->alamat }}</p>
    </aside>

    <!-- Katalog -->
    <main class="w-3/4 p-10">
        <h2 class="text-3xl font-bold mb-6">Katalog</h2>

        <div class="border rounded-xl p-6 flex space-x-6 bg-white shadow">
            <img src="{{ asset('storage/' . $bibit->foto_bibit) }}"
                    alt="{{ $bibit->nama_bibit }}"
                    class="w-[300px] h-[300px] object-cover rounded-xl">

            <div class="w-1/2">
                <p class="text-sm text-green-700 font-semibold">{{ $bibit->JenisBibit->jenis_bibit ?? '-' }}</p>
                <h3 class="text-xl font-bold">{{ $bibit->nama_bibit }}</h3>
                <p class="text-sm">Stok : {{ $bibit->stok }}</p>
                <p class="text-2xl font-bold mt-2 mb-4">Rp{{ number_format($bibit->harga, 0, ',', '.') }}</p>
                <p class="font-semibold">Deskripsi Produk:</p>
                <p class="text-sm mb-2">{{ $bibit->deskripsi }}</p>

            </div>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('agen.katalog', ['rekantani_id' => $bibit->rekanTani->id]) }}" class="text-green-700 text-sm hover:text-green-900 hover:font-semibold transition duration-200 hover:underline">&lt; kembali</a>
            <a href="{{ route('v_formpengajuan', ['bibit_id' => $bibit->id]) }}"
                class="bg-green-700 hover:bg-green-800 hover:shadow-lg hover:scale-105 transform text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition duration-200">
                <span class="text-xl font-bold">+</span>
                <span>Buat Pengajuan</span>
            </a>
        </div>
    </main>
</div>
@endsection

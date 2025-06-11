@extends('rekantani.app')
@section('content')

<!-- Main Layout -->
<div class="flex flex-col md:flex-row min-h-screen"
    x-data="{ showVerifikasi: false, showTolak: false }">

    <!-- Modal Verifikasi -->
    <div x-show="showVerifikasi" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-8 rounded-xl shadow-md text-center">
            <p class="text-xl font-semibold mb-6">Yakin Memverifikasi Pembayaran ini?</p>
            <div class="flex justify-center space-x-4">
                <button @click="showVerifikasi = false"
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-full">Batal</button>

                <form method="POST" action="{{ route('rekantani.pembayaran.verifikasi', $pengajuan->id) }}">
                    @csrf
                    <button type="submit"
                            class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-6 rounded-full">Yakin</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tolak -->
    <div x-show="showTolak" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-8 rounded-xl shadow-md text-center">
            <p class="text-xl font-semibold mb-6">Yakin Menolak Pengajuan ini?</p>
            <div class="flex justify-center space-x-4">
                <button @click="showTolak = false"
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-full">Batal</button>

                <form method="POST" action="{{ route('rekantani.pembayaran.tolak', $pengajuan->id) }}">
                    @csrf
                    <button type="submit"
                            class="bg-green-700 hover:bg-green-800 text-white font-bold py-2 px-6 rounded-full">Yakin</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="bg-gray-100 p-6 rounded-lg shadow-md w-full md:w-1/3 flex flex-col items-center text-center">
        <img src="{{ asset('storage/'. $pengajuan->agen->foto_profil) }}"
            class="w-32 h-32 rounded-full object-cover mb-4" alt="Foto Mitra">
        <h3 class="font-bold text-lg">{{ $pengajuan->agen->nama }}</h3>
        <div class="text-sm text-gray-600 mt-2 space-y-1">
            <p>Tanggal Pengajuan : {{ \Carbon\Carbon::parse($pengajuan->created_at)->format('d/m/Y') }}</p>
            <p>Status Pengajuan :
                {{
                    is_null($pengajuan->status_pengajuan) ? 'Perlu diproses' :
                    ($pengajuan->status_pengajuan == 0 ? '❌ Ditolak' : '✔ Diterima')
                }}
            </p>
            <p>Status Pembayaran :
                @if($pengajuan->status_pembayaran == 1)
                    <span class="text-green-600">Lunas</span>
                @else
                    <span class="text-yellow-600">Belum Lunas</span>
                @endif
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 bg-white p-6">

        <h1 class="text-2xl font-bold mb-6">Pengajuan</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <p><span class="font-semibold">Jenis Bibit:</span> {{ $pengajuan->bibit->jenis_bibit ?? 'Tidak diketahui' }}</p>
            <p><span class="font-semibold">Nama Bibit:</span> {{ $pengajuan->bibit->nama_bibit ?? 'Tidak diketahui' }}</p>
            <p><span class="font-semibold">Jumlah Bibit:</span> {{ $pengajuan->jumlah_permintaan }}</p>
            <p><span class="font-semibold">Tanggal Kebutuhan Bibit:</span> {{ \Carbon\Carbon::parse($pengajuan->tgl_kebutuhan)->format('d/m/Y') }}</p>
            <p><span class="font-semibold">Jadwal Pengiriman Bibit:</span> {{ \Carbon\Carbon::parse($pengajuan->jadwal_pengiriman)->format('d/m/Y') }}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-lg font-bold mb-2">Lokasi Pengiriman Bibit</h2>
            <p>{{ $pengajuan->lokasi_pengiriman }}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-lg font-bold mb-2">Keterangan</h2>
            <p>{{ $pengajuan->keterangan ?? '-'}}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-lg font-bold mb-2">Kontak Narahubung</h2>
            <a href="https://wa.me/{{ $pengajuan->narahubung }}" target="blank" class="text-blue-600 hover:underline">wa.me/{{ $pengajuan->narahubung }}</a>
        </div>

        <div class="mb-6">
            <h2 class="text-lg font-bold mb-2">Bukti Transfer</h2>
            <a href="{{ asset('storage/'.$pengajuan->bukti_bayar) }}" target="_blank"
                class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded hover:underline">
                {{ basename($pengajuan->bukti_bayar) }}
            </a>
        </div>

        <div class="flex justify-end space-x-4">
            @if(is_null($pengajuan->status_pembayaran))
                <button @click="showTolak = true"
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg">
                    Tolak
                </button>
                <button @click="showVerifikasi = true"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg">
                    Verifikasi
                </button>
            @endif
        </div>
    </div>
</div>

@endsection

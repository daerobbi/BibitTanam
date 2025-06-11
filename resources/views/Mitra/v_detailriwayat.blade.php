@extends('Mitra.app')
@section('content')
<main class="max-w-4xl mx-auto p-6 ml-6">
    <h2 class="text-3xl font-bold mb-4">Pengajuan</h2>
    <div class="space-y-1 mb-6 border-b pb-4">
        <p><strong>Pengajuan Oleh</strong> : {{ $pengajuan->agen->nama ?? '-' }}</p>
        <p><strong>Kepada</strong> : {{ $pengajuan->bibit->rekanTani->nama ?? '-' }}</p>
        <p><strong>Tanggal Pengajuan</strong> : {{ \Carbon\Carbon::parse($pengajuan->created_at)->format('d/m/Y') }}</p>
        <p><strong>Status Pengajuan</strong> :
            @if($pengajuan->status_pengajuan === 1)
                <span class="text-green-600 font-semibold">✓ Diterima</span>
            @elseif($pengajuan->status_pengajuan === 0 )
                <span class="text-red-600 font-semibold">✗ Ditolak</span>
            @else
                <span class="text-yellow-600 font-semibold">proses</span>
            @endif
        </p>
        <p><strong>Status Pembayaran</strong> :
            @if($pengajuan->status_pembayaran === 1)
                <span class="text-green-500">✔ Terbayar</span>
            @else
                <span class="text-red-500">✗ Belum Terbayar</span>
            @endif
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6 border-b pb-4">
        <div>
            <p class="text-sm text-gray-500">Jenis Bibit</p>
            <p class="font-medium">{{ $pengajuan->bibit->jenisBibit->jenis_bibit ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Nama Bibit</p>
            <p class="font-medium">{{ $pengajuan->bibit->nama_bibit ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Jumlah Bibit</p>
            <p class="font-medium">{{ $pengajuan->jumlah_permintaan }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6 border-b pb-4">
        <div>
            <p class="text-sm text-gray-500">Tanggal Kebutuhan Bibit</p>
            <p class="font-medium">{{ \Carbon\Carbon::parse($pengajuan->tanggal_dibutuhkan)->format('d/m/Y') }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Jadwal Pengiriman Bibit</p>
            <p class="font-medium">{{ $pengajuan->tanggal_pengiriman ? \Carbon\Carbon::parse($pengajuan->tanggal_pengiriman)->format('d/m/Y') : '-' }}</p>
        </div>
    </div>

    <div class="mb-6 border-b pb-4">
        <p class="text-sm text-gray-500">Lokasi Pengiriman Bibit</p>
        <p class="font-medium">{{ $pengajuan->lokasi_pengiriman }}</p>
    </div>

    <div class="mb-6 border-b pb-4">
        <p class="text-sm text-gray-500">Keterangan</p>
        <p class="font-medium">{{ $pengajuan->keterangan }}</p>
    </div>

    <div class="mb-6 border-b pb-4">
        <p class="text-sm text-gray-500">Kontak Narahubung</p>
        <p class="font-medium">{{ $pengajuan->narahubung }}</p>
    </div>

    @if($pengajuan->status_pengajuan !== 0)
        <div class="mb-6">
            <p class="text-sm text-gray-500 mb-3">Bukti Transfer</p>
            <div class="space-x-4">
                <a href="{{ asset('storage/'.$pengajuan->foto_invoice) }}" target="_blank" class="bg-gray-400 text-white px-4 py-2 rounded">Tagihan</a>
                <a href="{{ asset('storage/'.$pengajuan->bukti_bayar) }}" target="_blank" class="bg-green-400 text-white px-4 py-2 rounded">Bukti TF</a>
            </div>
        </div>
    @endif

    <div class="mt-4 text-right">
        <a href="{{ route('agen.riwayat') }}" class="text-green-600 hover:underline text-sm">&lt; kembali</a>
    </div>
</main>
@endsection

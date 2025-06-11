@extends('rekantani.app')

@section('content')
<div x-data="{ showModal: false }" class="max-w-3xl mx-auto p-8 pl-16">
    <h1 class="text-3xl font-bold mb-4">Pengajuan</h1>

    <div class="text-base mb-4 space-y-1">
        <p><span class="font-semibold">Pengajuan Oleh :</span> {{ $pengajuan->agen->nama }}</p>
        <p><span class="font-semibold">Kepada :</span> {{ $akunRekan->nama }}</p>
        <p>Tanggal Pengajuan : <span>{{ $pengajuan->created_at->format('d/m/Y') }}</span></p>
        <p>Status Pengajuan :
            <span class="font-semibold {{ $pengajuan->status_pengajuan === 1 ? 'text-green-600' : 'text-red-600' }}">
                {{ $pengajuan->status_pengajuan === 1 ? '✔ Diterima' : '✘ Ditolak' }}
            </span>
        </p>
        <p>Status Pembayaran :
            <span class="font-semibold {{ $pengajuan->status_pembayaran === 1 ? 'text-green-500' : 'text-red-500' }}">
                {{ $pengajuan->status_pembayaran === 1 ? '✔ Terbayar' : '✘ Belum Terbayar' }}
            </span>
        </p>
    </div>

    <div class="border-t border-gray-300 my-4"></div>

    <div class="text-base space-y-1">
        <p><span class="font-semibold">Jenis Bibit</span> : {{ $pengajuan->bibit->jenisBibit->jenis_bibit }}</p>
        <p><span class="font-semibold">Nama Bibit</span> : {{ $pengajuan->bibit->nama_bibit }}</p>
        <p><span class="font-semibold">Jumlah Bibit</span> : {{ $pengajuan->jumlah_permintaan }}</p>
    </div>

    <div class="border-t border-gray-300 my-4"></div>

    <div class="text-base space-y-1">
        <p><span class="font-semibold">Tanggal Kebutuhan Bibit</span> :
            {{ \Carbon\Carbon::parse($pengajuan->tanggal_dibutuhkan)->format('d/m/Y') }}
        </p>
        <p><span class="font-semibold">Jadwal Pengiriman Bibit</span> :
            {{ $pengajuan->tanggal_pengiriman ? \Carbon\Carbon::parse($pengajuan->tanggal_pengiriman)->format('d/m/Y') : '-' }}
        </p>
    </div>

    <div class="border-t border-gray-300 my-4"></div>

    <div class="text-base space-y-1">
        <p><span class="font-semibold">Lokasi Pengiriman Bibit</span></p>
        <p>{{ $pengajuan->lokasi_pengiriman }}</p>
    </div>

    <div class="border-t border-gray-300 my-4"></div>

    <div class="text-base space-y-1">
        <p><span class="font-semibold">Keterangan</span></p>
        <p>{{ $pengajuan->keterangan ?? '-' }}</p>
    </div>

    <div class="border-t border-gray-300 my-4"></div>

    <div class="text-base space-y-1">
        <p><span class="font-semibold">Kontak Narahubung</span></p>
        <p>
            <a href="https://wa.me/{{ $pengajuan->narahubung }}" target="_blank" class="text-blue-600 underline">
                {{$pengajuan->narahubung}}
            </a>
        </p>
    </div>

    <div class="border-t border-gray-300 my-4"></div>

    <div class="text-base space-y-3">
        <div>
            <p class="font-semibold mb-1">Invoice Pembayaran</p>
            <a href="{{ asset('storage/'.$pengajuan->foto_invoice) }}" target="_blank" class="block bg-gray-300 text-gray-800 px-4 py-2 rounded w-fit">
                Klik disini
            </a>
        </div>

        <div>
            <p class="font-semibold mb-1">Bukti Transfer</p>
            <a href="{{ asset('storage/'.$pengajuan->bukti_bayar) }}" target="_blank" class="block bg-green-300 text-green-900 px-4 py-2 rounded w-fit">
                klik disini
            </a>
        </div>
    </div>

    <!-- Buttons -->
    <div class="flex justify-end gap-4 mt-8">
        <a href="{{ route('rekantani.distribusi') }}" class="bg-red-700 hover:bg-red-800 text-white font-semibold text-base px-6 py-2 rounded inline-block">
            Kembali
        </a>
        @if($pengajuan->status_pengiriman !== 'dikirim')
        <button @click="showModal = true" class="bg-green-800 hover:bg-green-900 text-white font-semibold text-base px-6 py-2 rounded">
            Kirim Bibit
        </button>
        @endif
    </div>

    <!-- Modal Konfirmasi -->
    <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;">
        <div class="bg-white p-8 rounded-xl shadow-md text-center w-full max-w-md" @click.away="showModal = false">
            <p class="text-lg font-medium mb-6">Yakin Mengubah Status Pengiriman?</p>
            <div class="flex justify-center gap-6">
                <button @click="showModal = false" class="bg-red-700 hover:bg-red-800 text-white font-bold px-6 py-2 rounded-full">
                    Batal
                </button>
                <form action="{{ route('rekantani.dikirim', $pengajuan->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-800 hover:bg-green-900 text-white font-bold px-6 py-2 rounded-full">
                        Yakin
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

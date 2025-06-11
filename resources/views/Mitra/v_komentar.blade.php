@extends('Mitra.app')
@section('content')

<style>
    [x-cloak] { display: none !important; }
</style>

<div class="max-w-7xl mx-auto p-6 grid grid-cols-1 md:grid-cols-2 gap-8 bg-white rounded-lg shadow">

    <!-- Kolom Kiri: Detail Broadcast -->
    <section>
        <h2 class="text-xl font-bold mb-2 flex items-center gap-x-2">
            <img src="{{ asset('asset/toa.png') }}" class="w-6 h-6" />
            {{ strtoupper($broadcast->judul_broadcast) }}
        </h2>
        <p class="font-semibold">Pengajuan Oleh : <span class="text-black">{{ $broadcast->agen->nama }}</span></p>
        <p class="text-red-600 font-semibold mb-6">Tenggat : {{ \Carbon\Carbon::parse($broadcast->tanggal_kebutuhan)->format('d/m/Y') }}</p>

        <div class="divide-y text-sm space-y-3">
            <div class="pb-2">
                <p class="font-semibold">Nama Bibit</p>
                <p>{{ $broadcast->nama_bibit }}</p>
            </div>
            <div class="py-2">
                <p class="font-semibold">Jumlah Bibit</p>
                <p>{{ $broadcast->jumlah_bibit }}</p>
            </div>
            <div class="py-2">
                <p class="font-semibold">Tanggal Kebutuhan Bibit</p>
                <p>{{ \Carbon\Carbon::parse($broadcast->tanggal_kebutuhan)->format('d/m/Y') }}</p>
            </div>
            <div class="py-2">
                <p class="font-semibold">Lokasi Pengiriman Bibit</p>
                <p>{{ $broadcast->lokasi }}</p>
            </div>
            <div class="py-2">
                <p class="font-semibold">Deskripsi</p>
                <p>{{ $broadcast->deskripsi }}</p>
            </div>
            <div class="pt-2">
                <p class="font-semibold">Kontak Narahubung</p>
                <p>
                    <a href="https://wa.me/{{ $broadcast->kontak }}" class="text-blue-600 underline" target="_blank">
                        wa.me/{{ $broadcast->kontak }}
                    </a>
                </p>
            </div>
        </div>
    </section>

    <!-- Kolom Kanan: Komentar -->
    <section>
        <h3 class="text-lg font-semibold mb-4">{{ $komentars->count() }} Komentar</h3>

        <div class="space-y-4">
            @foreach ($komentars as $komentar)
                <div class="border p-4 rounded-lg relative text-sm bg-gray-50">
                    @if ($komentar->user->agen)
                        <p class="font-bold">{{ $komentar->user->agen->nama }}</p>
                    @elseif ($komentar->user->rekantani)
                        <p class="font-bold">{{ $komentar->user->rekantani->nama }}</p>
                    @else
                        <p class="font-bold">Nama Tidak Diketahui</p>
                    @endif

                    <p class="mt-1">{{ $komentar->isi_komentar }}</p>

                    @if (Auth::user()->role === 'agen')
                        <form method="POST" action="{{ route('agen.komentar.hapus', $komentar->id) }}" class="absolute top-2 right-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-gray-500 hover:text-red-600 text-xs flex items-center gap-1">
                                <img src="{{ asset('asset/sampah.png') }}">Hapus
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>

            <!-- Flash Message -->
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 1500)" x-show="show" x-cloak x-transition
                class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
                <div class="bg-white rounded-3xl p-8 w-full max-w-md text-center shadow-lg">
                    <h2 class="text-xl font-medium text-gray-700 mb-6">{{ session('success') }}</h2>
                    <div class="flex justify-center">
                        <div class="bg-green-600 rounded-full w-24 h-24 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="3"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Komentar -->
        <form method="POST" action="{{ route('agen.broadcast.komentar', $broadcast->id) }}" class="mt-6 flex items-center gap-2">
            @csrf
            <input type="text" name="isi_komentar" placeholder="Tambahkan Komentar.." required
                class="flex-1 border border-gray-300 rounded-full px-4 py-2 text-sm" />
            <button class="bg-green-200 text-white rounded-full p-3 hover:bg-green-400" type="submit">
                <img src="{{ asset('asset/kertas.png') }}">
            </button>
        </form>
    </section>
</div>

@endsection

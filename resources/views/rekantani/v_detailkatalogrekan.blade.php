@extends('rekantani.app')

@section('content')
    <!-- Sembunyikan elemen dengan x-cloak sampai Alpine.js aktif -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <div x-data="{ modalHapus: false, modalSukses: false }">

        <div class="px-10 py-6 flex flex-col">
            <!-- Judul Halaman -->
            <h1 class="text-3xl font-bold mb-6">Katalog</h1>

            <!-- Card Detail Produk -->
            <div class="border rounded-xl p-8 flex gap-8 items-start bg-white shadow">
                <!-- Gambar -->
                <img src={{ asset('storage/' . $detailKatalog->foto_bibit) }} alt="Bibit Lidah Mertua"
                    class="rounded-lg w-[360px] h-[360px] object-cover">

                <!-- Detail -->
                <div class="flex-1">
                    <div class="text-green-700 font-medium mb-1">{{ $detailKatalog->jenisBibit->jenis_bibit }}</div>
                    <h2 class="text-2xl font-semibold">{{ $detailKatalog->nama_bibit }}</h2>
                    <div class="text-gray-500 text-sm mb-2">Stok : {{ $detailKatalog->stok }}</div>
                    <div class="text-2xl font-bold text-black mb-6">{{ $detailKatalog->harga }}
                    </div>

                    <!-- Deskripsi -->
                    <div class="text-sm text-gray-700 leading-relaxed space-y-4">
                        <div>
                            <strong>Deskripsi Produk:</strong><br />
                            {{ $detailKatalog->deskripsi }}
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="flex gap-3 mt-8">
                        <a href="{{ route('rekantani.katalog') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-black px-6 py-2 rounded-full font-semibold">
                            Kembali
                        </a>
                        <button @click="modalHapus = true"
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full font-semibold">
                            Hapus
                        </button>

                        <a href="{{ route('rekantani.editkatalog',  ['id' => $detailKatalog->id]) }}"
                            class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded-full font-semibold">
                            Edit
                        </a>

                    </div>

                </div>
            </div>
        </div>
        @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 1500)" x-show="show" x-transition
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white rounded-3xl p-8 w-full max-w-md text-center shadow-lg">
                <h2 class="text-xl font-medium text-gray-700 mb-6">{{ session('success') }}</h2>
                <div class="flex justify-center">
                    <div class="bg-green-800 rounded-full w-24 h-24 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="3"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- Modal Konfirmasi Hapus -->
        <div x-show="modalHapus" x-cloak class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50"
            x-transition>
            <div class="bg-white rounded-3xl p-8 w-full max-w-md text-center shadow-lg" @click.away="modalHapus = false">
                <h2 class="text-xl font-medium text-gray-700 mb-8">Yakin Menghapus Katalog Ini ?</h2>
                <form action={{ route('rekantani.katalog.delete', ['id' => $detailKatalog->id]) }} method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-center gap-6">
                        <a href="" class="bg-red-600 text-white px-6 py-2 rounded-full font-semibold hover:bg-red-700">Batal</a>
                </form>
                <button
                    @click="
                        modalHapus = false;
                        setTimeout(() => modalSukses = true, 300);
                        setTimeout(() => modalSukses = false, 1800);
                    "
                    class="bg-green-800 text-white px-6 py-2 rounded-full font-semibold hover:bg-green-900">
                    Yakin
                </button>
            </div>
        </div>
    </div>
@endsection

@extends('rekantani.app')
@section('content')
<style>
    [x-cloak] { display: none !important; }
</style>

<div x-data="modalHandler()" class="relative">

<div class="flex flex-col md:flex-row max-w-7xl mx-auto my-10 p-4 gap-6">

    <!-- Sidebar -->
    <div class="bg-white p-6 rounded-lg shadow-md w-full md:w-1/3 flex flex-col items-center text-center">
        <img src="{{ asset('storage/' . $pengajuan->agen->foto_profil) }}" class="w-32 h-32 rounded-full object-cover mb-4" alt="Foto Mitra">
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

    <!-- Detail Pengajuan -->
    <div class="bg-white p-6 rounded-lg shadow-md w-full md:w-2/3">
        <h2 class="text-2xl font-semibold mb-4">Pengajuan</h2>
        <div class="space-y-4 text-sm">
            <div class="grid grid-cols-2">
                <p class="font-semibold">Jenis Bibit</p>
                <p>{{ $pengajuan->bibit->jenisBibit->jenis_bibit }}</p>

                <p class="font-semibold">Nama Bibit</p>
                <p>{{ $pengajuan->bibit->nama_bibit }}</p>

                <p class="font-semibold">Jumlah Bibit</p>
                <p>{{ $pengajuan->jumlah_permintaan }}</p>
            </div>
            <hr>

            <div class="grid grid-cols-2">
                <p class="font-semibold">Tanggal Kebutuhan Bibit</p>
                <p>{{ \Carbon\Carbon::parse($pengajuan->tanggal_dibutuhkan)->format('d/m/Y') }}</p>

                <p class="font-semibold">Jadwal Pengiriman Bibit</p>
                <p>{{ \Carbon\Carbon::parse($pengajuan->tanggal_pengiriman)->format('d/m/Y') }}</p>
            </div>

            <hr>

            <div>
                <p class="font-semibold">Lokasi Pengiriman Bibit</p>
                <p>{{ $pengajuan->lokasi_pengiriman }}</p>
            </div>

            <hr>

            <div>
                <p class="font-semibold">Keterangan</p>
                <p>{{ $pengajuan->keterangan }}</p>
            </div>

            <hr>

            <div class="mb-6">
                <p class="font-semibold">Kontak Narahubung</p>
                <p>{{ $pengajuan->narahubung }}</p>
            </div>

            @if($pengajuan->file_invoice)
            <div class="text-center mt-6">
                <p class="font-semibold mb-2">Invoice</p>
                <img src="{{ asset('storage/' . $pengajuan->file_invoice) }}" alt="Invoice" class="mx-auto w-60">
            </div>
            @endif

            <div class="flex justify-between items-center mt-8">
                @if($pengajuan->status_pengajuan === null)  <!-- Status 'perlu diproses' -->
                <button @click="openModal('upload')" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-lg flex items-center gap-2">
                    Upload & Terima Pengajuan
                </button>
                <button @click="openModal('delete')" class="bg-red-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-red-700">
                    Tolak
                </button>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Upload Invoice + Terima -->
<div x-show="modal === 'upload'" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" x-cloak>
    <form action="{{ route('rekantani.pengajuan.terima', ['id' => $pengajuan->id]) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl p-8 text-center w-96">
        @csrf
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Upload Invoice untuk Menerima</h2>

        <input type="file" name="foto_invoice" accept="image/*" class="block w-full mb-4 p-2 border rounded-lg" required>

        <div class="flex justify-center gap-4 mt-6">
            <button type="button" @click="closeModal()" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                Batal
            </button>
            <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">
                Upload & Terima
            </button>
        </div>
    </form>
</div>

<!-- Modal Tolak -->
<div x-show="modal === 'delete'" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" x-cloak>
    <form action="{{ route('rekantani.pengajuan.tolak', ['id' => $pengajuan->id]) }}" method="POST" class="bg-white rounded-3xl p-8 text-center w-96">
        @csrf
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Yakin Menolak Pengajuan?</h2>

        <div class="flex justify-center gap-4 mt-6">
            <button type="button" @click="closeModal()" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                Batal
            </button>
            <button type="submit" class="bg-green-700 text-white px-6 py-2 rounded-lg hover:bg-green-800">
                Tolak
            </button>
        </div>
    </form>
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
</div>

<script>
    function modalHandler() {
        return {
            modal: null,
            openModal(type) {
                this.modal = type;
            },
            closeModal() {
                this.modal = null;
            }
        }
    }
</script>
@endsection

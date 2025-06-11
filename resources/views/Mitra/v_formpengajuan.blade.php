@extends('Mitra.app')

@section('content')
<style>
    [x-cloak] { display: none !important; }
</style>

<div class="flex min-h-screen" x-data="{ showConfirm: false }">
    <!-- Sidebar -->
    <aside class="w-1/4 h-screen sticky top-0 bg-gray-200 p-6 flex flex-col items-center shadow-md min-h-full">
        <img src="{{ asset('storage/' . ($bibit->rekanTani->foto_profil ?? '#')) }}" alt="Petani" class="rounded-full w-40 h-40 object-cover mb-4">
        <h2 class="text-xl font-bold mb-2">{{ $bibit->rekanTani->nama ?? 'Nama Petani' }}</h2>
        <p class="text-sm text-gray-600 mb-1">Lokasi : {{ $bibit->rekanTani->kota->nama_kota ?? '-' }}</p>
        <p class="text-sm text-gray-600 text-center mb-1">Jenis Bibit : {{ $bibit->JenisBibit->jenis_bibit ?? '-' }}</p>
        <p class="text-sm text-gray-600 text-center mb-1">Kontak : {{ $bibit->rekanTani->no_hp }}</p>
        <p class="text-sm text-gray-600 text-center mb-1">Alamat : {{ $bibit->rekanTani->alamat }}</p>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10 relative">

        <h1 class="text-2xl font-bold mb-6">Form Pengajuan</h1>
        <form id="formPengajuan" action="{{ route('agen.submitpengajuan', ['bibit_id' => $bibit->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="bibit_id" value="{{ $bibit->id }}">

            <!-- Field Bibit -->
            <div class="mb-4">
                <label class="block text-sm font-medium">Jenis Bibit</label>
                <input type="text" value="{{ $bibit->JenisBibit->jenis_bibit ?? '-' }}" class="mt-1 w-full border rounded-md p-2" disabled />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Nama Bibit</label>
                <input type="text" value="{{ $bibit->nama_bibit }}" class="mt-1 w-full border rounded-md p-2" disabled />
            </div>

            <!-- Inputan Pengguna -->
            <div class="mb-4">
                <label class="block text-sm font-medium">Jumlah Bibit</label>
                <input type="number" name="jumlah_permintaan" placeholder="Harap isi jumlah bibit" class="mt-1 w-full border rounded-md p-2" required />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Tanggal Kebutuhan</label>
                <input type="date" name="tanggal_dibutuhkan" class="mt-1 w-full border rounded-md p-2" required />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Tanggal Pengiriman</label>
                <input type="date" name="tanggal_pengiriman" class="mt-1 w-full border rounded-md p-2"/>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Lokasi Pengiriman</label>
                <textarea name="lokasi_pengiriman" placeholder="Harap isi alamat lengkap" class="mt-1 w-full border rounded-md p-2" rows="2" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Keterangan</label>
                <textarea name="keterangan" placeholder="Keterangan tambahan (opsional)" class="mt-1 w-full border rounded-md p-2" rows="3"></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Kontak Narahubung</label>
                <input type="number" name="narahubung" placeholder="Contoh : 628XXXXXXXXXX" class="mt-1 w-full border rounded-md p-2" required />
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('v_detailkatalog', ['bibit_id' => $bibit->id]) }}" class="text-green-600 hover:underline text-sm">&lt; kembali</a>
                <button type="button" @click="showConfirm = true" class="bg-green-700 hover:bg-green-800 text-white font-semibold px-6 py-2 rounded-full">Kirim Pengajuan</button>
            </div>
        </form>
    </main>

    <!-- Modal Konfirmasi -->
    <div x-show="showConfirm" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-transition>
        <div class="bg-gray-300 rounded-[50px] p-10 text-center">
            <h2 class="text-3xl font-semibold text-gray-700 mb-8">Yakin Mengirimkan Ajuan?</h2>
            <div class="flex justify-center gap-8">
                <button @click="showConfirm = false" class="bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-2 rounded-full">Batal</button>
                <button
                    @click="
                        const requiredFields = document.querySelectorAll('#formPengajuan input[required], #formPengajuan textarea[required]');
                        let allFilled = true;
                        requiredFields.forEach(f => {
                            if (!f.value.trim()) {
                                allFilled = false;
                                f.classList.add('border-red-500');
                            } else {
                                f.classList.remove('border-red-500');
                            }
                        });
                        if (!allFilled) {
                            showConfirm = false;
                            document.getElementById('modalError').classList.remove('hidden');
                            setTimeout(() => document.getElementById('modalError').classList.add('hidden'), 3000);
                        } else {
                            document.getElementById('formPengajuan').submit();
                        }
                    "
                    class="bg-green-700 hover:bg-green-800 text-white font-bold px-8 py-2 rounded-full"
                >
                    Yakin
            </button>
            </div>
        </div>
    </div>
    @if (session('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 1500)" x-show="show" x-transition
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white rounded-3xl p-8 w-full max-w-md text-center shadow-lg">
            <h2 class="text-xl font-medium text-gray-700 mb-6">{{ session('error') }}</h2>
            <div class="flex justify-center">
                <div class="bg-red-600 rounded-full w-24 h-24 flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="3"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

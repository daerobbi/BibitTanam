@extends('Mitra.app')

@section('content')
<style>
    [x-cloak] { display: none !important; }
</style>

<div class="flex min-h-screen" x-data="modalHandler()">
    <!-- Sidebar -->
    <aside class="w-1/4 h-screen sticky top-0 bg-gray-200 p-6 flex flex-col items-center shadow-md min-h-full">
        <img src="{{ asset('storage/' .$pengajuan->bibit->rekanTani->foto_profil)}}" alt="Petani" class="rounded-full w-40 h-40 object-cover mb-4">
        <h2 class="text-xl font-bold mb-2">{{ $pengajuan->bibit->rekanTani->nama ?? '-' }}</h2>
        <p class="text-sm text-gray-600 mb-1">Lokasi : {{ $pengajuan->bibit->rekanTani->kota->nama_kota ?? '-' }}</p>
        <p class="text-sm text-gray-600 text-center mb-1">Jenis Bibit : {{ $pengajuan->bibit->jenisBibit->jenis_bibit ?? '-' }}</p>
        <p class="text-sm text-gray-600 text-center mb-1">Kontak : {{ $pengajuan->bibit->rekanTani->no_hp }}</p>
        <p class="text-sm text-gray-600 text-center mb-1">Alamat : {{ $pengajuan->bibit->rekanTani->alamat }}</p>
    </aside>

    <!-- Form -->
    <div class="w-2/3 p-8">
        <h1 class="text-2xl font-bold mb-6">Detail Pengajuan</h1>

        <form id="form-update" action="{{ route('agen.updatepengajuan', $pengajuan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label class="block text-gray-700 font-medium">Jenis Bibit</label>
                    <input type="text" value="{{ $pengajuan->bibit->jenisBibit->jenis_bibit ?? '-' }}" class="w-full border rounded px-3 py-2" disabled />
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Nama Bibit</label>
                    <input type="text" value="{{ $pengajuan->bibit->nama_bibit ?? '-' }}" class="w-full border rounded px-3 py-2" disabled />
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Jumlah Bibit</label>
                    <input type="number" name="jumlah_permintaan" value="{{ old('jumlah_permintaan', $pengajuan->jumlah_permintaan) }}" class="w-full border rounded px-3 py-2" />
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Tanggal Kebutuhan Bibit</label>
                    <input type="date" name="tanggal_dibutuhkan" value="{{ old('tanggal_dibutuhkan', $pengajuan->tanggal_dibutuhkan) }}" class="w-full border rounded px-3 py-2" />
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Jadwal Pengiriman Bibit</label>
                    <input type="date" name="tanggal_pengiriman" value="{{ old('tanggal_pengiriman', $pengajuan->tanggal_pengiriman) }}" class="w-full border rounded px-3 py-2" />
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Lokasi Pengiriman Bibit</label>
                    <textarea name="lokasi_pengiriman" class="w-full border rounded px-3 py-2" rows="2">{{ old('lokasi_pengiriman', $pengajuan->lokasi_pengiriman) }}</textarea>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Keterangan</label>
                    <textarea name="keterangan" class="w-full border rounded px-3 py-2" rows="2">{{ old('keterangan', $pengajuan->keterangan) }}</textarea>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium">Kontak Narahubung</label>
                    <input type="number" name="narahubung" value="{{ old('narahubung', $pengajuan->narahubung) }}" class="w-full border rounded px-3 py-2" />
                </div>
            </div>
        </form>

        <!-- Buttons -->
        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('v_pengajuanterbaru') }}" class="text-green-600 hover:underline text-sm">&lt; kembali</a>
            <div class="flex gap-4">
                <button @click="openModal('edit')" class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700">Edit</button>

                <form id="form-delete" action="{{ route('agen.hapuspengajuan', $pengajuan->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" @click="openModal('delete')" class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700">Hapus</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div x-show="modal === 'edit'" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" x-cloak>
        <div class="bg-gray-300 rounded-3xl px-10 py-8 text-center">
            <h2 class="text-3xl font-medium text-gray-800 mb-8">Yakin Merubah Data Pengajuan?</h2>
            <div class="flex justify-center gap-4">
                <button @click="closeModal()" class="bg-red-700 text-white font-bold px-10 py-3 rounded-xl">Batal</button>
                <button @click="confirmAction('edit')" class="bg-green-800 text-white font-bold px-10 py-3 rounded-xl">Yakin</button>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div x-show="modal === 'delete'" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" x-cloak>
        <div class="bg-gray-300 rounded-3xl px-10 py-8 text-center">
            <h2 class="text-3xl font-medium text-gray-800 mb-8">Yakin Menghapus Pengajuan?</h2>
            <div class="flex justify-center gap-4">
                <button @click="closeModal()" class="bg-red-700 text-white font-bold px-10 py-3 rounded-xl">Batal</button>
                <button @click="confirmAction('delete')" class="bg-green-800 text-white font-bold px-10 py-3 rounded-xl">Yakin</button>
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

<script>
    function modalHandler() {
        return {
            modal: null,

            openModal(type) {
                this.modal = type;
            },

            closeModal() {
                this.modal = null;
            },

            confirmAction(type) {
                let isValid = true;
                // Clear previous errors
                document.querySelectorAll('#form-update .text-red-500.text-sm').forEach(el => el.remove());
                document.querySelectorAll('#form-update input, #form-update textarea').forEach(input => {
                    input.classList.remove('border-red-500');
                });

                // Validate fields
                document.querySelectorAll('#form-update input, #form-update textarea').forEach(input => {
                    const name = input.getAttribute('name');
                    const value = input.value.trim();

                    // Skip validation for 'tanggal_pengiriman' and 'keterangan'
                    if (name === 'tanggal_pengiriman' || name === 'keterangan') {
                        return;
                    }

                    if (input.type !== 'checkbox' && value === '') {
                        isValid = false;
                        input.classList.add('border-red-500'); // Red border

                        if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('text-red-500')) {
                            const errorMsg = document.createElement('p');
                            errorMsg.textContent = 'Harap isi data';
                            errorMsg.classList.add('text-red-500', 'text-sm');
                            input.parentNode.appendChild(errorMsg);
                        }
                    }
                });

                if (isValid) {
                    if (type === 'edit') {
                        document.getElementById('form-update').submit();
                    } else if (type === 'delete') {
                        document.getElementById('form-delete').submit();
                    }
                } else {
                    this.closeModal(); // <-- Tambahkan ini kalau ada error, modal langsung ditutup
                }
            }
        }
    }
</script>


@endsection

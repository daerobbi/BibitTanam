@extends('rekantani.app')

@section('content')
<style>[x-cloak] { display: none !important; }</style>

<div x-data="{ modalGagal: false }">
    <div class="max-w-6xl mx-auto mt-8 bg-white p-8 rounded-md shadow">
        <h1 class="text-3xl font-bold mb-6 text-center">Tambah Produk</h1>

        <form action="{{ route('rekantani.tambah.katalog') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Upload Gambar -->
                <div x-data="{ imagePreview: null }" class="flex flex-col items-center">
                    <div class="w-64 h-64 border-2 border-gray-300 rounded-md flex items-center justify-center relative overflow-hidden">
                        <input type="file" id="uploadFoto" accept="image/*" name="foto_bibit"
                            class="absolute inset-0 hidden cursor-pointer z-10"
                            @change="
                                const file = $event.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => imagePreview = e.target.result;
                                    reader.readAsDataURL(file);
                                }
                            " />
                        <template x-if="imagePreview">
                            <img :src="imagePreview" class="absolute inset-0 object-cover w-full h-full" />
                        </template>
                        <template x-if="!imagePreview">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 16l4-4a3 3 0 014 0l5 5a3 3 0 004 0l4-4M3 16v4a1 1 0 001 1h16a1 1 0 001-1v-4" />
                            </svg>
                        </template>
                    </div>
                    <label for="uploadFoto" class="mt-4 bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded cursor-pointer">
                        Upload Gambar Produk
                    </label>
                </div>

                <!-- Form Input -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium">Jenis Bibit</label>
                        <select class="w-full border rounded px-3 py-2 mt-1" name="jenis_bibit_id" required>
                            <option value="" disabled selected>Pilih jenis bibit</option>
                            @foreach ($jenisBibitList as $jenis)
                                <option value="{{ $jenis->id }}">{{ $jenis->jenis_bibit}}</option>
                            @endforeach
                        </select>
                        @error('jenis_bibit_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Nama Bibit</label>
                        <input type="text" name="nama_bibit" class="w-full border rounded px-3 py-2 mt-1" required />
                        @error('nama_bibit')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Stok</label>
                        <input type="number" name="stok" class="w-full border rounded px-3 py-2 mt-1" required />
                        @error('stok')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Harga</label>
                        <input type="number" name="harga" class="w-full border rounded px-3 py-2 mt-1" required />
                        @error('harga')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" class="w-full border rounded px-3 py-2 mt-1" required></textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end mt-6 space-x-4">
                <a href="{{ route('rekantani.katalog') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">Batal</a>
                <button type="button"
                    @click="() => {
                        const inputs = document.querySelectorAll('input, textarea, select');
                        let valid = true;
                        inputs.forEach(i => { if (!i.value.trim()) valid = false; });
                        if (!valid) {
                            modalGagal = true;
                            setTimeout(() => modalGagal = false, 1500);
                        } else {
                            $refs.submitForm.click();
                        }
                    }"
                    class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded">
                    Simpan
                </button>
            </div>

            <!-- Tombol Submit Tersembunyi -->
            <button type="submit" class="hidden" x-ref="submitForm"></button>
        </form>

        <!-- Modal Gagal -->
        <div x-show="modalGagal" x-transition x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white px-12 py-10 rounded-3xl text-center shadow-2xl w-[90%] max-w-md">
                <h2 class="text-2xl font-semibold mb-6">Harap isi semua data!</h2>
                <div class="bg-red-600 rounded-full w-24 h-24 mx-auto flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

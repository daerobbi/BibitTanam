@extends('rekantani.app')

@section('content')
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <div x-data="{ modalGagal: false }">
        <div class="max-w-6xl mx-auto mt-8 bg-white p-8 rounded-md shadow">
            <h1 class="text-3xl font-bold mb-6 text-center">Edit Katalog</h1>

            <form method="POST" action="{{ route('rekantani.katalog.update', $bibit->id) }}" enctype="multipart/form-data"
                x-data="{ imagePreview: '{{ asset('storage/' . $bibit->foto_bibit) }}' }">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Gambar -->
                    <div class="flex flex-col items-center">
                        <div
                            class="w-64 h-64 border-2 border-gray-300 rounded-md flex items-center justify-center relative overflow-hidden">
                            <input type="file" id="uploadFoto" name="foto_bibit" accept="image/*"
                                class="absolute inset-0 opacity-0 cursor-pointer z-10"
                                @change="
                                const file = $event.target.files[0];
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        imagePreview = e.target.result;
                                    };
                                    reader.readAsDataURL(file);
                                }
                            " />
                            <template x-if="imagePreview">
                                <img :src="imagePreview" alt="Preview"
                                    class="absolute inset-0 object-cover w-full h-full" />
                            </template>
                        </div>
                        <label for="uploadFoto"
                            class="mt-4 bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 flex items-center gap-2 cursor-pointer">
                            Ubah Gambar Produk
                        </label>
                    </div>

                    <!-- Form -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium">Jenis Bibit</label>
                            <select name="id_jenisbibit" class="w-full border border-gray-300 rounded px-3 py-2 mt-1">
                                @foreach ($jenisBibitList as $jenis)
                                    <option value="{{ $jenis->id }}"
                                        {{ $bibit->id_jenisbibit == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->jenis_bibit }} <!-- Menampilkan nama jenis bibit -->
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium">Nama Bibit</label>
                            <input type="text" name="nama_bibit" value="{{ old('nama_bibit', $bibit->nama_bibit) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 mt-1" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Stok</label>
                            <input type="number" name="stok" value="{{ old('stok', $bibit->stok) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 mt-1" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Harga</label>
                            <input type="number" name="harga" value="{{ old('harga', $bibit->harga) }}"
                                class="w-full border border-gray-300 rounded px-3 py-2 mt-1" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium">Deskripsi</label>
                            <textarea name="deskripsi" rows="5" class="w-full border border-gray-300 rounded px-3 py-2 mt-1">{{ old('deskripsi', $bibit->deskripsi) }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end mt-6 space-x-4">
                    <a href="{{ route('rekantani.detailkatalog', $bibit->id) }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">Batal</a>
                    <button type="submit"
                        class="bg-green-700 hover:bg-green-800 text-white px-6 py-2 rounded">Simpan</button>
                </div>
            </form>
        </div>

        @if ($errors->any())
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 1000)" x-show="show" x-transition
                class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
                <div class="bg-white rounded-3xl p-8 w-full max-w-md text-center shadow-lg">
                    <h2 class="text-xl font-medium text-gray-700 mb-6">Harap isi semua Data!</h2>
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

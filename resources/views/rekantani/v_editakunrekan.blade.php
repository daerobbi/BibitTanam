@extends('rekantani.app')

@section('content')
<div x-data="{
    showConfirm: false,
    photoPreview: '{{ asset('storage/' . $rekan->foto_profil) }}',
    previewFile(event) {
        const input = event.target;
        if (!input.files || !input.files[0]) return;
        const reader = new FileReader();
        reader.onload = e => {
            this.photoPreview = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}">
    <main class="max-w-4xl mx-auto px-6 py-8">
        <div class="flex justify-end items-center space-x-3 mb-6">
            <p class="text-black text-lg font-normal select-none">
                Hallo, {{ $rekan->nama }}!
            </p>
            <img alt="Foto Profil" class="w-10 h-10 rounded-full object-cover"
                src="{{ asset('storage/' . $rekan->foto_profil) }}" width="40" height="40" />
        </div>

        <form
            id="profileForm"
            x-ref="profileForm"
            action="{{ route('rekan.profil.update') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6 max-w-3xl mx-auto"
        >
            @csrf

            <section class="bg-white rounded-xl p-6 md:p-10 shadow-sm max-w-4xl mx-auto">
                <div class="flex justify-center mb-5">
                    <img
                        :src="photoPreview"
                        alt="Foto Sampul"
                        class="rounded-xl max-w-full h-auto object-cover"
                        height="200"
                        width="700"
                    />
                </div>
                <div class="flex justify-center mb-8">
                    <button
                        type="button"
                        @click="$refs.fileInput.click()"
                        class="bg-[#22c55e] text-white font-semibold text-sm rounded-full px-4 py-1.5 hover:bg-[#16a34a] transition"
                    >
                        Ubah Foto Profil
                    </button>
                </div>

                <input
                    type="file"
                    name="foto_profil"
                    x-ref="fileInput"
                    class="hidden"
                    accept="image/*"
                    @change="previewFile($event)"
                />

                <div>
                    <label class="block mb-1 text-gray-600 text-sm font-normal select-none">Nama</label>
                    <input
                        name="nama"
                        type="text"
                        value="{{ old('nama', $rekan->nama) }}"
                        class="w-full rounded-md bg-gray-100 text-black text-xs px-3 py-2 border focus:outline-none focus:ring-2 focus:ring-green-400"
                    />
                    @error('nama')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 text-gray-600 text-sm font-normal select-none">Email</label>
                    <input
                        name="email"
                        type="email"
                        value="{{ old('email', $rekan->user->email) }}"
                        class="w-full rounded-md bg-gray-100 text-black text-xs px-3 py-2 border focus:outline-none focus:ring-2 focus:ring-green-400"
                    />
                    @error('email')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 text-gray-600 text-sm font-normal select-none">Kota</label>
                    <select
                        name="id_kota"
                        class="w-full rounded-md bg-gray-100 text-black text-xs px-3 py-2 border focus:outline-none focus:ring-2 focus:ring-green-400"
                    >
                        @foreach($kotaList as $kota)
                            <option value="{{ $kota->id }}"
                                {{ old('kota_id', $rekan->id_kota) == $kota->id ? 'selected' : '' }}>
                                {{ $kota->nama_kota }}
                            </option>
                        @endforeach
                    </select>
                    @error('kota_id')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 text-gray-600 text-sm font-normal select-none">Alamat</label>
                    <textarea
                        name="alamat"
                        rows="3"
                        class="w-full rounded-md bg-gray-100 text-black text-xs px-3 py-2 border resize-none focus:outline-none focus:ring-2 focus:ring-green-400"
                    >{{ old('alamat', $rekan->alamat) }}</textarea>
                    @error('alamat')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 text-gray-600 text-sm font-normal select-none">No WhatsApp</label>
                    <input
                        name="no_hp"
                        type="number"
                        value="{{ old('no_hp', $rekan->no_hp) }}"
                        class="w-full rounded-md bg-gray-100 text-black text-xs px-3 py-2 border focus:outline-none focus:ring-2 focus:ring-green-400"
                    />
                    @error('no_hp')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="border-t pt-6 mt-6">
                    <h3 class="text-gray-800 font-semibold text-sm mb-4 select-none">Ubah Password (Opsional)</h3>

                    <div class="space-y-4">
                        <div>
                            <label class="block mb-1 text-gray-600 text-sm">Password Lama</label>
                            <input type="password" name="password_lama"
                                class="w-full rounded-md bg-gray-100 text-xs px-3 py-2 border focus:ring-green-400">
                            @error('password_lama') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block mb-1 text-gray-600 text-sm">Password Baru</label>
                            <input type="password" name="password_baru"
                                class="w-full rounded-md bg-gray-100 text-xs px-3 py-2 border focus:ring-green-400">
                            @error('password_baru') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block mb-1 text-gray-600 text-sm">Konfirmasi Password Baru</label>
                            <input type="password" name="konfirmasi_password"
                                class="w-full rounded-md bg-gray-100 text-xs px-3 py-2 border focus:ring-green-400">
                            @error('konfirmasi_password') <p class="text-red-600 text-xs">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>
            </section>
        </form>

        <!-- Modal Konfirmasi -->
        <div
            x-show="showConfirm"
            x-transition
            class="fixed inset-0 bg-black bg-opacity-30 flex items-center justify-center z-50"
            style="display: none;"
            @keydown.escape.window="showConfirm = false"
        >
            <div class="bg-white rounded-xl p-8 max-w-lg w-full text-center shadow-lg">
                <h2 class="text-gray-700 font-semibold text-xl mb-8">Yakin Menyimpan Perubahan ?</h2>
                <div class="flex justify-center space-x-6">
                    <button
                        type="button"
                        @click="showConfirm = false"
                        class="bg-red-600 text-white font-bold px-6 py-2 rounded-full hover:bg-red-700 transition"
                    >
                        Batal
                    </button>
                    <button
                        type="button"
                        @click="$refs.profileForm.submit()"
                        class="bg-green-800 text-white font-bold px-6 py-2 rounded-full hover:bg-green-900 transition"
                    >
                        Yakin
                    </button>
                </div>
            </div>
        </div>
    </main>

    <div class="fixed bottom-8 right-8">
        <button
            type="button"
            @click="showConfirm = true"
            class="bg-[#22c55e] text-white font-semibold text-sm rounded-full px-4 py-2 hover:bg-[#16a34a] transition"
        >
            Simpan
        </button>
    </div>
</div>
@endsection

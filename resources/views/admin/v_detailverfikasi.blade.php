@extends('admin.app')

@section('content')
<div x-data="modalHandler()" class="max-w-5xl mx-auto px-6 py-10">

    <div class="mb-6">
        <h1 class="text-3xl font-extrabold mb-2">Detail Akun</h1>
        <h2 class="text-green-800 font-semibold text-xl select-text">
            {{ ucfirst($role) }}
        </h2>
        <p class="text-sm mt-1">
            Status Akun:
            @if (is_null($user->status_akun))
                <span class="text-yellow-500 font-semibold">Menunggu Verifikasi</span>
            @else
                <span class="text-red-600 font-semibold">Ditolak</span>
            @endif
        </p>
    </div>

    <section class="max-w-4xl">
        <dl class="grid grid-cols-[max-content_1fr] gap-x-6 gap-y-3 text-base">
            <dt class="font-bold">Tanggal Mendaftar :</dt>
            <dd class="mb-2">{{ $tanggal_daftar }}</dd>

            <dt class="font-bold">Nama :</dt>
            <dd class="mb-2">{{ $nama }}</dd>

            <dt class="font-bold">Mendaftar Sebagai :</dt>
            <dd class="mb-2">{{ ucfirst($role) }}</dd>

            @if ($role === 'rekantani')
                <dt class="font-bold">Kota Domisili :</dt>
                <dd class="mb-2">{{ $kota }}</dd>
            @endif
        </dl>

        <hr class="my-6 border-t border-gray-300" />

        <dl class="grid grid-cols-[max-content_1fr] gap-x-6 gap-y-3 text-base">
            <dt class="font-bold pt-1">Alamat :</dt>
            <dd class="pt-1 mb-2 max-w-[600px]">{{ $alamat }}</dd>
        </dl>

        <hr class="my-6 border-t border-gray-300" />

        <dl class="grid grid-cols-[max-content_1fr] gap-x-6 gap-y-3 text-base">
            <dt class="font-bold pt-1">No. WhatsApp :</dt>
            <dd class="pt-1 mb-2">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $no_wa) }}" class="underline text-blue-600" target="_blank">
                    {{ $no_wa }}
                </a>
            </dd>
        </dl>

        <hr class="my-6 border-t border-gray-300" />

        <dl class="grid grid-cols-[max-content_1fr] gap-x-6 gap-y-3 text-base items-center">
            <dt class="font-bold">Dokumen Pendaftaran :</dt>
            <dd class="mb-2">
                @if ($dokumen)
                    <a href="{{ asset('storage/' . $dokumen) }}"
                        class="inline-block bg-green-400 text-white px-4 py-1 rounded-lg underline"
                        target="_blank">
                        bukti usaha
                    </a>
                @else
                    <span class="text-gray-600 italic">Tidak ada dokumen</span>
                @endif
            </dd>
        </dl>
    </section>

    @if (is_null($user->status_akun))
    <div class="flex justify-end max-w-4xl mt-10 space-x-6">
        <button
            @click="openModal('reject')"
            class="bg-red-700 hover:bg-red-800 text-white font-bold text-lg rounded-lg px-8 py-3"
            type="button"
        >
            Tolak
        </button>
        <button
            @click="openModal('verify')"
            class="bg-green-700 hover:bg-green-800 text-white font-bold text-lg rounded-lg px-8 py-3"
            type="button"
        >
            Verifikasi
        </button>
    </div>
    @endif

    <!-- Modal Tolak -->
    <div
        x-show="modal === 'reject'"
        class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50"
        x-cloak
    >
        <div class="bg-white rounded-3xl px-10 py-8 text-center max-w-md mx-4">
            <h2 class="text-3xl font-medium text-gray-800 mb-8">Yakin Menolak Akun Ini?</h2>
            <div class="flex justify-center gap-4">
                <button
                    @click="closeModal()"
                    class="bg-red-700 text-white font-bold px-10 py-3 rounded-xl"
                >
                    Batal
                </button>
                <form action="{{ route('verifikasi.tolak', $user->id) }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="bg-green-700 text-white font-bold px-10 py-3 rounded-xl"
                    >
                        Yakin
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Verifikasi -->
    <div
        x-show="modal === 'verify'"
        class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50"
        x-cloak
    >
        <div class="bg-white rounded-3xl px-10 py-8 text-center max-w-md mx-4">
            <h2 class="text-3xl font-medium text-gray-800 mb-8">Yakin Memverifikasi Akun Ini?</h2>
            <div class="flex justify-center gap-4">
                <button
                    @click="closeModal()"
                    class="bg-gray-400 text-white font-bold px-10 py-3 rounded-xl"
                >
                    Batal
                </button>
                <form action="{{ route('verifikasi.verifikasi', $user->id) }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="bg-green-700 text-white font-bold px-10 py-3 rounded-xl"
                    >
                        Yakin
                    </button>
                </form>
            </div>
        </div>
    </div>
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

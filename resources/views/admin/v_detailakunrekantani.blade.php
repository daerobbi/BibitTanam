@extends('admin.app')

@section('content')
<div x-data="modalHandler()" class="max-w-5xl mx-auto px-6 py-10">
    <div class="mb-6">
        <h1 class="text-3xl font-extrabold mb-2">Detail Akun</h1>
        <h2 class="text-green-800 font-semibold text-xl select-text">Rekan Tani</h2>
        <p class="text-sm mt-1">
            Status Akun:
            @if (is_null($rekantani->user->status_akun))
                <span class="text-yellow-500 font-semibold">Menunggu Verifikasi</span>
            @elseif ($rekantani->user->status_akun == 0)
                <span class="text-red-600 font-semibold">Ditolak</span>
            @elseif ($rekantani->user->status_akun == 1)
                <span class="text-green-600 font-semibold">Terverifikasi</span>
            @endif
        </p>
    </div>

    <section class="max-w-4xl">
        <dl class="grid grid-cols-[max-content_1fr] gap-x-6 gap-y-3 text-base">
            <dt class="font-bold">Tanggal Mendaftar :</dt>
            <dd class="mb-2">
                {{ \Carbon\Carbon::parse($rekantani->created_at)->translatedFormat('d F Y') }}
            </dd>

            <dt class="font-bold">Nama :</dt>
            <dd class="mb-2">{{ $rekantani->nama }}</dd>

            <dt class="font-bold">Mendaftar Sebagai :</dt>
            <dd class="mb-2">Rekan Tani</dd>

            <dt class="font-bold">Kota Domisili :</dt>
            <dd class="mb-2">{{ $rekantani->kota->nama_kota ?? '-' }}</dd>
        </dl>

        <hr class="my-6 border-t border-gray-300" />

        <dl class="grid grid-cols-[max-content_1fr] gap-x-6 gap-y-3 text-base">
            <dt class="font-bold pt-1">Alamat :</dt>
            <dd class="pt-1 mb-2 max-w-[600px]">{{ $rekantani->alamat }}</dd>
        </dl>

        <hr class="my-6 border-t border-gray-300" />

        <dl class="grid grid-cols-[max-content_1fr] gap-x-6 gap-y-3 text-base">
            <dt class="font-bold pt-1">No. WhatsApp :</dt>
            <dd class="pt-1 mb-2">
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $rekantani->no_hp) }}" class="underline text-blue-600" target="_blank">
                    {{ $rekantani->no_hp }}
                </a>
            </dd>
        </dl>

        <hr class="my-6 border-t border-gray-300" />

        <dl class="grid grid-cols-[max-content_1fr] gap-x-6 gap-y-3 text-base items-center">
            <dt class="font-bold">Dokumen Pendaftaran :</dt>
            <dd class="mb-2">
                @if ($rekantani->bukti_usaha)
                    <a href="{{ asset('storage/' . $rekantani->bukti_usaha) }}"
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

    <div class="flex justify-end max-w-4xl mt-10 space-x-6">
        <a href="{{ route('admin.rekantani') }}" class="bg-red-700 hover:bg-red-800 text-white font-bold text-lg rounded-lg px-8 py-3">Kembali</a>
    </div>
</div>
@endsection

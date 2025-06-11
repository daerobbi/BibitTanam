@extends('Mitra.app')
@section('content')

<div
    x-data="{ showSuccess: {{ session('success') ? 'true' : 'false' }} }"
    x-init="if (showSuccess) {
        setTimeout(() => showSuccess = false, 1500);
    }">
<!-- Header -->
<div class="bg-gray-100 py-8">
    <h1 class="text-center text-3xl font-bold">Pengajuan Terbaru</h1>
</div>
<!-- Table -->
<div class="max-w-6xl mx-auto mt-6 bg-white px-8 py-6 shadow-sm">
    <table class="w-full text-left text-sm">
        <thead class="border-b border-gray-300">
            <tr class="text-gray-700">
                <th class="py-3">No</th>
                <th class="py-3">Tanggal Pengajuan</th>
                <th class="py-3">Rekan Tani</th>
                <th class="py-3">Nama Bibit</th>
                <th class="py-3">Keterangan</th>
                <th class="py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-300">
            @forelse ($pengajuan as $key => $item)
                @if($item->status_pengajuan !== 0 && $item->status_pembayaran !== 1) <!-- Menambahkan pengecekan status_pengajuan -->
                    <tr>
                        <td class="py-4">{{ $key + 1 }}.</td>
                        <td class="py-4">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                        <td class="py-4">{{ $item->bibit->rekanTani->nama ?? '-' }}</td>
                        <td class="py-4">{{ $item->bibit->nama_bibit ?? '-' }}</td>
                        <td class="py-4 font-medium
                            @if($item->status_pengajuan === 1) text-green-600
                            @else text-gray-500
                            @endif
                        ">
                            {{ ucfirst($item->status_pengajuan === null ? 'proses' : ($item->status_pengajuan === 1 ? 'diterima' : 'ditolak')) }}
                        </td>

                        <td class="py-4">
                            @php
                                // Cek tujuan link berdasarkan status_pengajuan
                                if ($item->status_pengajuan == 1 ) {
                                    $link = route('agen.formpembayaran', ['pengajuan_id' => $item->id]);
                                } else {
                                    $link = route('agen.detailpengajuan', ['pengajuan_id' => $item->id]);
                                }
                            @endphp
                            <a href="{{ $link }}"
                                class="bg-green-800 text-white px-4 py-1 rounded-full text-sm font-semibold hover:bg-green-950">
                                Detail
                            </a>
                        </td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">
                        Belum ada pengajuan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6">
        <a href="{{ route('v_pengajuan') }}" class="text-green-700 text-sm font-medium hover:underline">&lt; kembali</a>
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
</div>
@endsection

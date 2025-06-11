@extends('rekantani.app')
@section('content')
<div class="bg-white py-10 shadow-sm">
    <h1 class="text-3xl font-bold text-center">Pengajuan Masuk</h1>
</div>

<!-- Table Section - Lebar Full -->
<div class="w-full px-6 mt-6">
    <div class="bg-white rounded-md shadow overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-700">
        <thead class="bg-gray-100 text-gray-600 uppercase">
            <tr>
                <th class="px-4 py-3">No</th>
                <th class="px-4 py-3">Tanggal Pengajuan</th>
                <th class="px-4 py-3">Tanggal Kebutuhan Bibit</th>
                <th class="px-4 py-3">Agen</th>
                <th class="px-4 py-3">Status Pengajuan</th>
                <th class="px-4 py-3">Status Pembayaran</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody>
            <tbody>
                @foreach ($pengajuan as $index => $item)
                @if (
                    (is_null($item->status_pembayaran) || $item->status_pembayaran != 1)
                    && (is_null($item->status_pengajuan) || $item->status_pengajuan != 0)
                )
                                <tr class="border-t">
                    <td class="px-4 py-3">{{ $index + 1 }}.</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->tanggal_dibutuhkan)->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">{{ $item->agen->nama}}</td>
                    <td class="px-4 py-3 text-gray-500">
                        {{
                            is_null($item->status_pengajuan) ? 'Perlu diproses' :
                            ($item->status_pengajuan == 0 ? '❌ Ditolak' : '✔ Diterima')
                        }}
                    </td>
                    <td class="px-4 py-3 text-gray-500">
                        {{
                            $item->bukti_bayar == null ? '❌ Belum Dibayar' : '✔ Sudah Dibayar' }}
                    </td>
                    <td class="px-4 py-3">
                        <td class="px-4 py-3">
                            @if ($item->bukti_bayar == null)
                                <a href="{{ route('rekantani.detailpengajuan', $item->id) }}"
                                    class="bg-yellow-600 text-white px-4 py-1 rounded-full text-sm hover:bg-yellow-500 transition-colors duration-200">
                                    Detail Pengajuan
                                </a>
                            @else
                                <a href="{{ route('rekantani.pengajuan.pembayaran', $item->id) }}"
                                    class="bg-green-800 text-white px-4 py-1 rounded-full text-sm hover:bg-green-700 transition-colors duration-200">
                                    Verifikasi Pembayaran
                                </a>
                            @endif
                        </td>

                    </td>
                </tr>
                @endif
            @endforeach
            </tbody>
    </tbody>
    </table>
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
    @if (session('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 1500)" x-show="show" x-transition
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white rounded-3xl p-8 w-full max-w-md text-center shadow-lg">
            <h2 class="text-xl font-medium text-gray-700 mb-6">{{ session('error') }}</h2>
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

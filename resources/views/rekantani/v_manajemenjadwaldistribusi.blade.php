@extends('rekantani.app')
@section('content')

<div class="max-w-7xl w-full mx-auto bg-white rounded-lg shadow p-8">
    <!-- Title -->
    <h1 class="text-center text-2xl font-semibold mb-8">Pengajuan Terverifikasi</h1>

    <!-- Filter Section -->
    <div class="flex justify-between mb-6">
        <form method="GET" action="{{ route('rekantani.distribusi') }}" class="flex space-x-4">
            <div class="flex space-x-2">
                <div class="relative">
                    <input type="text" placeholder="Cari Berdasarkan Nama Agen" name="search" class="border rounded-full pl-10 pr-4 py-2 w-64 text-sm focus:outline-none" value="{{ request()->search }}">
                    <svg class="w-4 h-4 absolute left-3 top-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <div class="relative">
                    <select name="status_pengiriman" class="border rounded-full px-4 py-2 text-sm appearance-none pr-8">
                        <option value="">Semua Status</option>
                        <option value="diproses" {{ request()->status_pengiriman == 'diproses' ? 'selected' : '' }}>Proses</option>
                        <option value="dikirim" {{ request()->status_pengiriman == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    </select>
                    <svg class="w-4 h-4 absolute right-3 top-3 text-gray-400 pointer-events-none" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white text-sm rounded-full px-4 py-2 flex items-center space-x-1">
                <span>Cari</span>
            </button>
        </form>
        <a href="{{ route('rekantani.riwayat') }}" class="bg-green-500 hover:bg-green-600 text-white text-sm rounded-full px-4 py-2 flex items-center space-x-1">
            <span>Lihat Riwayat Pengajuan</span>
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-gray-500">
                <tr class="border-t">
                    <th class="py-2 text-center">No</th>
                    <th class="py-2 text-center">Tanggal Pengiriman</th>
                    <th class="py-2 text-center">Tanggal Kebutuhan Bibit</th>
                    <th class="py-2 text-center">Agen</th>
                    <th class="py-2 text-center">Status Distribusi Bibit</th>
                    <th class="py-2 text-center"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuan as $index => $item)
                    @if ($item->status_pengiriman === 'selesai')
                        @continue
                    @endif
                    <tr class="border-t">
                        <td class="py-3 text-center">{{ $index + 1 }}.</td>
                        <td class="py-3 text-center">
                            {{ $item->tanggal_pengiriman ? \Carbon\Carbon::parse($item->tanggal_pengiriman)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="py-3 text-center">{{ \Carbon\Carbon::parse($item->tanggal_dibutuhkan)->format('d/m/Y') }}</td>
                        <td class="py-3 text-center">{{ $item->agen->nama }}</td>
                        <td class="py-3 text-center text-green-600">
                            {{ $item->status_pengiriman === 'diproses' ? 'Proses' : '✓ Dikirim' }}
                        </td>
                        <td class="py-3 text-center">
                            <a href="{{ route('rekantani.detailpengiriman', ['id' => $item->id]) }}" class="bg-green-700 hover:bg-green-800 text-white rounded-full px-4 py-1">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
@endsection

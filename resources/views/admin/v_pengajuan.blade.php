@extends('admin.app')
@section('content')
<div class="bg-white py-6 text-center shadow">
    <h1 class="text-2xl font-bold">Pengajuan</h1>
</div>

<form method="GET" action="{{ route('admin.pengajuan') }}" class="flex flex-wrap gap-4 px-6 py-4 bg-white shadow mt-4 items-center">
    <div class="flex items-center gap-2">
        <div class="relative">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari Agen atau Rekan Tani..."
                class="pl-10 pr-4 py-2 rounded-full border w-72 focus:outline-none focus:ring-2 focus:ring-green-500"/>
            <div class="absolute left-3 top-2.5 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
                </svg>
            </div>
        </div>
        <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-full">Cari</button>
    </div>

    <!-- Dropdown Bulan -->
    <select name="bulan" class="border rounded-full px-4 py-2">
        <option value="">Semua Bulan</option>
        @foreach(range(1,12) as $bulan)
            <option value="{{ sprintf('%02d', $bulan) }}" {{ request('bulan') == sprintf('%02d', $bulan) ? 'selected' : '' }}>
                {{ DateTime::createFromFormat('!m', $bulan)->format('F') }}
            </option>
        @endforeach
    </select>

    <!-- Dropdown Status -->
    <select name="status" class="border rounded-full px-4 py-2">
        <option value="Semua Pengajuan" {{ request('status') == 'Semua Pengajuan' ? 'selected' : '' }}>Semua Pengajuan</option>
        <option value= "1" {{ request('status') == 1 ? 'selected' : '' }}>Diterima</option>
        <option value= "0" {{ request('status') == 0 ? 'selected' : '' }}>Ditolak</option>
    </select>
</form>

<!-- Tabel Pengajuan -->
<div class="px-6 py-4">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow text-sm">
            <thead class="border-b text-center">
                <tr>
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Tanggal</th>
                    <th class="py-3 px-4">Agen</th>
                    <th class="py-3 px-4">Rekan Tani</th>
                    <th class="py-3 px-4">Jumlah Bibit</th>
                    <th class="py-3 px-4">Status Pengajuan</th>
                    <th class="py-3 px-4"></th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($pengajuan as $item)
                <tr class="border-t">
                    <td class="py-3 px-4">{{ $loop->iteration }}.</td>
                    <td class="py-3 px-4">{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d/m/Y') }}</td>
                    <td class="py-3 px-4">{{ $item->agen->nama ?? '-' }}</td>
                    <td class="py-3 px-4">{{ $item->bibit->rekanTani->nama ?? '-' }}</td>
                    <td class="py-3 px-4">{{ $item->jumlah_permintaan }}</td>
                    <td class="py-3 px-4 {{ $item->status_pengajuan == 1 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $item->status_pengajuan == 1 ? '✔ Diterima' : '✖ Ditolak' }}
                    </td>
                    <td class="py-3 px-4">
                        <a href="{{ route('v_detailpengajuanadmin', $item->id) }}" class="bg-green-800 text-white px-4 py-1 rounded-full text-sm hover:bg-green-700 transition duration-300">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4">Tidak ada data pengajuan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

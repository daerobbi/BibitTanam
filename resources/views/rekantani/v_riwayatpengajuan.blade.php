@extends('rekantani.app')
@section('content')


    <!-- Title -->
    <div class="bg-gray-100 py-8 text-center">
        <h1 class="text-3xl font-bold">Riwayat Pengajuan</h1>
    </div>

    <!-- Filters -->
    <form action="{{ route('rekantani.riwayat') }}" method="GET" class="flex justify-between items-center max-w-screen-xl mx-auto mt-8 mb-4 px-6 space-x-4">
        <div class="flex w-full max-w-4xl space-x-4">
            <div class="relative flex-grow">
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari Agen/Bibit" class="w-full border border-gray-300 rounded-full py-2 px-4 pl-10 focus:outline-none">
                <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.41-1.41l4.28 4.3-1.42 1.4-4.27-4.3zM14 8a6 6 0 11-12 0 6 6 0 0112 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="relative">
                <select name="status" class="border border-gray-300 rounded-full py-2 px-4 focus:outline-none">
                    <option value="">Semua Status</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded-full hover:bg-green-800">Cari</button>
        </div>
    </form>

    <!-- Table -->
    <div class="max-w-screen-xl mx-auto px-6 overflow-x-auto">
        <table class="w-full text-center border-collapse">
            <thead class="border-b-2 border-gray-300">
                <tr class="text-gray-600">
                    <th class="py-2">No</th>
                    <th class="py-2">Tanggal Pengajuan</th>
                    <th class="py-2">Agen</th>
                    <th class="py-2">Nama Bibit</th>
                    <th class="py-2">Status Pengajuan</th>
                    <th class="py-2"></th>
                    <th class="py-2"></th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse ($pengajuan as $i => $row)
                <tr class="border-b border-gray-200">
                    <td class="py-4">{{ $i + 1 }}.</td>
                    <td class="py-4">{{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y') }}</td>
                    <td class="py-4">{{ $row->agen->nama ?? '-' }}</td>
                    <td class="py-4">{{ $row->bibit->nama_bibit ?? '-' }}</td>
                    <td class="py-4 font-semibold
                        @if ($row->status_pengajuan == 0)
                            text-red-600
                        @elseif ($row->status_pengiriman == 'selesai')
                            text-blue-600
                        @endif
                    ">
                        @if ($row->status_pengajuan == 0)
                            Ditolak
                        @else
                            {{ ucfirst($row->status_pengiriman) }}
                        @endif
                    </td>
                    <td class="py-4">
                        <a href="{{ route('rekantani.detailriwayat', $row->id) }}" class="bg-green-900 text-white px-4 py-1 rounded-full text-sm inline-block">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-8 text-gray-500">Tidak ada data pengajuan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

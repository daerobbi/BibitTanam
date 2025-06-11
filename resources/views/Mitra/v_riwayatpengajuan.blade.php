@extends('Mitra.app')
@section('content')

<!-- Alpine.js modal state -->
<div x-data="{ openModal: false, selectedId: null }">

    <!-- Title -->
    <div class="bg-gray-100 py-8 text-center">
        <h1 class="text-3xl font-bold">Riwayat Pengajuan</h1>
    </div>

    <!-- Filters -->
    <form action="{{ route('agen.riwayat') }}" method="GET" class="flex justify-between items-center max-w-screen-xl mx-auto mt-8 mb-4 px-6 space-x-4">
        <div class="flex w-full max-w-4xl space-x-4">
            <div class="relative flex-grow">
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari Rekan Tani/Bibit" class="w-full border border-gray-300 rounded-full py-2 px-4 pl-10 focus:outline-none">
                <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.41-1.41l4.28 4.3-1.42 1.4-4.27-4.3zM14 8a6 6 0 11-12 0 6 6 0 0112 0z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="relative">
                <select name="status" class="border border-gray-300 rounded-full py-2 px-4 focus:outline-none">
                    <option value="">Semua Status</option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="dikirim" {{ request('status') == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <button type="submit" class="bg-green-700 text-white px-4 py-2 rounded-full hover:bg-green-800">Cari</button>
        </div>
    </form>

    <!-- Table -->
    <div class="max-w-screen-xl mx-auto px-6 overflow-x-auto mb-8">
        <table class="w-full text-center border-collapse">
            <thead class="border-b-2 border-gray-300">
                <tr class="text-gray-600">
                    <th class="py-2">No</th>
                    <th class="py-2">Tanggal Pengajuan</th>
                    <th class="py-2">Rekan Tani</th>
                    <th class="py-2">Nama Bibit</th>
                    <th class="py-2">Status Pengiriman</th>
                    <th class="py-2"></th>
                    <th class="py-2"></th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse ($pengajuan as $i => $row)
                <tr class="border-b border-gray-200">
                    <td class="py-4">{{ $i + 1 }}.</td>
                    <td class="py-4">{{ \Carbon\Carbon::parse($row->created_at)->format('d/m/Y') }}</td>
                    <td class="py-4">{{ $row->bibit->rekanTani->nama ?? '-' }}</td>
                    <td class="py-4">{{ $row->bibit->nama_bibit ?? '-' }}</td>
                    <td class="py-4 font-semibold
                        @if ($row->status_pengajuan == 0)
                            text-red-600
                        @elseif ($row->status_pengiriman == 'dikirim')
                            text-green-600
                        @elseif ($row->status_pengiriman == 'selesai')
                            text-blue-600
                        @else
                            text-gray-500
                        @endif
                    ">
                        @if ($row->status_pengajuan == 0)
                            Ditolak
                        @else
                            {{ ucfirst($row->status_pengiriman) }}
                        @endif
                    </td>
                    <td class="py-4">
                        @if (!($row->status_pengiriman == 'selesai' || $row->status_pengajuan == 0))
                            <button @click="openModal = true; selectedId = '{{ $row->id }}'" class="bg-green-400 text-white px-4 py-1 rounded-full text-sm">Bibit Diterima</button>
                        @endif
                    </td>
                    <td class="py-4">
                        <a href="{{ route('agen.detailriwayat', $row->id) }}" class="bg-green-900 text-white px-4 py-1 rounded-full text-sm inline-block">Detail</a>
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

    <!-- Modal -->
<div x-show="openModal" x-cloak class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
        <p class="text-lg mb-6">Pastikan bibit benar-benar sudah anda terima.<br>Lanjutkan konfirmasi?</p>
        <div class="flex justify-center space-x-4">
            <button @click="openModal = false" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-full">Batal</button>
            <form :action="`{{ route('agen.selesai', '') }}/${selectedId}`" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="bg-green-700 hover:bg-green-800 text-white font-semibold px-6 py-2 rounded-full">Lanjutkan</button>
            </form>
        </div>
    </div>
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

@extends('admin.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    <h1 class="text-2xl font-bold mb-1">Daftar Rekan Tani Terverifikasi</h1>
    <p class="text-sm mb-6 max-w-3xl">Daftar rekan tani yang telah bergabung dan siap mendukung pertanian bersama BibitTanam.</p>

    <form method="GET" action="{{ route('admin.rekantani') }}" class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-4 sm:space-y-0 mb-8 max-w-md">
        <div class="relative w-full sm:w-auto">
            <input name="cari" value="{{ request('cari') }}" class="w-full sm:w-64 rounded-xl bg-gray-300 placeholder-gray-700 text-gray-900 py-2 pl-4 pr-10 focus:outline-none" placeholder="Cari Rekan Tani..." type="text"/>
            <i class="fas fa-search absolute right-3 top-1/2 -translate-y-1/2 text-gray-700"></i>
        </div>
        <select name="lokasi" class="rounded-xl bg-gray-300 text-gray-900 py-2 px-4 w-full sm:w-auto focus:outline-none">
            <option value="">Semua Lokasi</option>
            @foreach ($kotaList as $kota)
                <option value="{{ $kota }}" {{ request('lokasi') == $kota ? 'selected' : '' }}>{{ $kota }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-xl hover:bg-green-600">Filter</button>
    </form>

    <div class="w-full overflow-x-auto">
        <section class="bg-gray-50 p-6 rounded-md w-full min-w-[800px]">
            <table class="w-full border-collapse text-sm text-gray-900">
                <thead>
                    <tr class="border-b border-gray-300">
                        <th class="text-left py-3 px-4 w-12 font-normal">No</th>
                        <th class="text-left py-3 px-4 w-48 font-normal">Tanggal Terdaftar</th>
                        <th class="text-left py-3 px-4 font-normal">Rekan Tani</th>
                        <th class="text-left py-3 px-4 font-normal">Lokasi</th>
                        <th class="w-40"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rekans as $index => $rekan)
                        <tr class="border-b border-gray-300">
                            <td class="py-4 px-4">{{ $index + 1 }}.</td>
                            <td class="py-4 px-4">
                                {{ \Carbon\Carbon::parse($rekan->user->created_at)->format('d/m/Y') }}
                            </td>
                            <td class="py-4 px-4 flex items-center space-x-3">
                                <img alt="Foto Profil" class="w-8 h-8 rounded-full object-cover" src="{{ asset('storage/' . $rekan->foto_profil) }}" width="32" height="32" />
                                <span class="break-words">{{ $rekan->nama }}</span>
                            </td>
                            <td class="py-4 px-4">{{ $rekan->kota->nama_kota ?? '-' }}</td>
                            <td class="py-4 px-4">
                                <a href="{{ route('admin.rekantani.detail', $rekan->id) }}" class="bg-green-400 text-white font-semibold text-xs rounded-full px-4 py-1 hover:bg-green-500 transition">
                                    Detail Rekan Tani
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 px-4 text-center text-gray-500">Tidak ada data ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </div>
</div>
@endsection

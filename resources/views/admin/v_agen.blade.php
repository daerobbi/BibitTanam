@extends('admin.app')

@section('content')
<div class="px-8 py-8 max-w-7xl mx-auto">

    <h2 class="text-2xl font-bold mb-1 select-none">Daftar Agen Terverifikasi</h2>
    <p class="text-sm mb-6 select-none">Daftar Agen yang telah bergabung dan siap mendukung pertanian bersama BibitTanam.</p>

    <form class="mb-8 flex items-center space-x-2" method="GET" action="{{ route('admin.agen') }}">
        <label class="sr-only" for="search">Cari Agen</label>
        <div class="relative w-64">
            <input
                class="w-full rounded-lg bg-gray-300 py-2 pl-4 pr-10 text-gray-700 placeholder-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500"
                id="search"
                name="search"
                placeholder="Cari Agen..."
                type="search"
                value="{{ old('search', $search) }}"
            />
            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-600">
                <i class="fas fa-search"></i>
            </span>
        </div>
        <button
            type="submit"
            class="bg-green-500 text-white font-semibold rounded-lg px-4 py-2 hover:bg-green-600 transition"
        >
            Cari
        </button>
    </form>


    <section class="bg-gray-50 rounded-md p-6">
        <table class="w-full border-collapse text-sm text-gray-900">
            <thead>
                <tr class="border-b border-gray-300">
                    <th class="text-left py-3 px-4 w-16 font-normal select-none">No</th>
                    <th class="text-left py-3 px-4 w-48 font-normal select-none">Tanggal Terdaftar</th>
                    <th class="text-left py-3 px-4 font-normal select-none pl-28">Agen</th>
                    <th class="text-left py-3 px-4 font-normal select-none">Alamat</th>
                    <th class="w-32"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($agens as $index => $agen)
                <tr class="border-b border-gray-300">
                    <td class="py-5 px-4 select-none">{{ $agens->firstItem() + $index }}.</td>
                    <td class="py-5 px-4 select-none">{{ \Carbon\Carbon::parse($agen->user->created_at)->format('d/m/Y') }}</td>
                    <td class="py-5 px-4 flex items-center space-x-4 select-none pl-28">
                        @if ($agen->foto_profil)
                        <img alt="{{ $agen->nama }} agent profile picture" class="w-10 h-10 rounded-full object-cover" src="{{ asset('storage/' . $agen->foto_profil) }}" />
                        @else
                        <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-500">N/A</div>
                        @endif
                        <span>{{ $agen->nama }}</span>
                    </td>
                    <td class="py-5 px-4 select-none">{{ $agen->alamat }}</td>
                    <td class="py-5 px-4">
                        <a href="{{ route('admin.agen.detail', $agen->id) }}" class="bg-green-500 text-white font-semibold text-xs rounded-full px-4 py-1 hover:bg-green-600 transition select-none">
                            Detail Agen
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 select-none">Tidak ada agen ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $agens->withQueryString()->links() }}
        </div>
    </section>
</div>
@endsection

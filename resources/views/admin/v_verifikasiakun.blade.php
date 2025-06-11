@extends('admin.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8">
    <section>
        <h1 class="text-2xl font-semibold mb-1">
            <span class="font-extrabold">Verifikasi</span> Pendaftaran
        </h1>
        <h2 class="text-green-900 font-semibold text-lg mb-6 select-text">Rekan Tani / Agen</h2>

        {{-- Filter --}}
        <form method="GET" class="flex flex-wrap gap-4 mb-8">
            <select name="role" class="rounded-full border border-gray-300 px-5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-600">
                <option value="">Role</option>
                <option value="rekantani" {{ request('role') == 'rekantani' ? 'selected' : '' }}>Rekan Tani</option>
                <option value="agen" {{ request('role') == 'agen' ? 'selected' : '' }}>Agen</option>
            </select>
            <select name="status" class="rounded-full border border-gray-300 px-5 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-600">
                <option value="">Status</option>
                <option value="null" {{ request('status') == 'nuull' ? 'selected' : '' }}>Perlu Ditinjau</option>
                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-full text-sm hover:bg-green-700">Terapkan</button>
        </form>

        {{-- Statistik --}}
        <div class="flex flex-wrap gap-6 mb-10">
            <div class="bg-[#5f5a52] rounded-lg px-6 py-4 w-44">
                <p class="text-white font-extrabold text-2xl leading-none">{{ $countReview }}</p>
                <p class="text-white text-xs mt-1">akun perlu diverifikasi</p>
            </div>
            <div class="bg-[#1f7a52] rounded-lg px-6 py-4 w-44">
                <p class="text-white font-extrabold text-2xl leading-none">{{ $countAccepted }}</p>
                <p class="text-white text-xs mt-1">akun telah diverifikasi</p>
            </div>
            <div class="bg-[#d32f2f] rounded-lg px-6 py-4 w-44">
                <p class="text-white font-extrabold text-2xl leading-none">{{ $countRejected }}</p>
                <p class="text-white text-xs mt-1">akun ditolak</p>
            </div>
        </div>

        {{-- Tabel User --}}
        <table class="w-full bg-[#f7f7f7] text-left text-sm">
            <thead>
                <tr class="border-b border-gray-300">
                    <th class="py-4 px-6 w-[5%] font-normal">No</th>
                    <th class="py-4 px-6 w-[15%] font-normal">Tanggal Daftar</th>
                    <th class="py-4 px-6 w-[30%] font-normal">Nama</th>
                    <th class="py-4 px-6 w-[15%] font-normal">Role</th>
                    <th class="py-4 px-6 w-[15%] font-normal">Status Verifikasi</th>
                    <th class="py-4 px-6 w-[10%] font-normal"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $user)
                <tr class="border-b border-gray-300">
                    <td class="py-4 px-6">{{ $index + 1 }}</td>
                    <td class="py-4 px-6">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="py-4 px-6">
                        @if($user->role === 'agen')
                            {{ $user->agen->nama ?? '-' }}
                        @elseif($user->role === 'rekantani')
                            {{ $user->rekantani->nama ?? '-' }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="py-4 px-6 capitalize">{{ $user->role }}</td>
                    <td class="py-4 px-6 flex items-center gap-1">
                        @if($user->status_akun === 0)
                            <i class="fas fa-times text-red-700">Ditolak</i>
                        @else
                            Perlu Ditinjau
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        <a href="{{ route('admin.verifikasidetail', $user->id) }}" class="bg-green-500 text-white rounded-full px-4 py-1 text-sm font-semibold hover:bg-green-600">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">Tidak ada data ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>
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

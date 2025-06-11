@extends('rekantani.app')
@section('content')

<div class="flex flex-col lg:flex-row justify-between flex-grow px-16 py-16 gap-16 max-w-screen-2xl mx-auto w-full">

    <!-- Left Profile Card -->
    <section class="bg-white rounded-3xl shadow-lg p-10 max-w-2xl w-full flex flex-col items-center">
        <img alt="Foto Profil" class="rounded-2xl border border-gray-300 mb-8 w-full object-cover max-h-[320px]"
            src="{{ asset('storage/' . $rekan->foto_profil) }}" height="320" />

        <h2 class="font-extrabold text-2xl text-center mb-2">
            {{ $rekan->nama }}
        </h2>
        <p class="text-center text-gray-600 font-semibold text-lg mb-1">
            Rekan Tani
        </p>
        <p class="text-center text-gray-500 text-base mb-8">
            {{ $rekan->kota->nama_kota ?? '-' }}
        </p>

        <div class="w-full space-y-6 text-base">
            <div>
                <label class="block text-sm text-gray-500 mb-1 select-none">Nama Lengkap</label>
                <div class="w-full rounded-lg bg-gray-300 px-4 py-2.5">{{ $rekan->nama }}</div>
            </div>
            <div>
                <label class="block text-sm text-gray-500 mb-1 select-none">Email</label>
                <div class="w-full rounded-lg bg-gray-300 px-4 py-2.5">{{ $user->email }}</div>
            </div>
            <div>
                <label class="block text-sm text-gray-500 mb-1 select-none">Alamat</label>
                <div class="w-full rounded-lg bg-gray-300 px-4 py-2.5 whitespace-wrap">{{ $rekan->alamat }}</div>
            </div>
            <div>
                <label class="block text-sm text-gray-500 mb-1 select-none">No WhatsApp</label>
                <div class="w-full rounded-lg bg-gray-300 px-4 py-2.5">
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $rekan->no_hp) }}" target="_blank" class="hover:underline">
                        wa.me/{{ preg_replace('/[^0-9]/', '', $rekan->no_hp) }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Right account info -->
    <section class="flex flex-col flex-grow max-w-2xl w-full space-y-10">
        <div class="flex items-center justify-end space-x-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-700 text-white text-base font-semibold rounded-full px-6 py-3 flex items-center gap-2 hover:bg-red-900 transition">
                    Logout
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
            <h3 class="text-xl font-medium select-none">
                Hallo, {{ $rekan->nama }}!
            </h3>
            <img alt="Foto Profil" class="w-14 h-14 rounded-full object-cover"
                src="{{ asset('storage/' . $rekan->foto_profil) }}" width="56" height="56"/>
        </div>

        <div class="bg-white rounded-3xl shadow-lg p-10 space-y-6 max-w-2xl w-full">
            <h4 class="font-semibold text-lg select-none">Informasi Akun</h4>
            <div>
                <label class="block text-sm text-gray-500 mb-1 select-none">Username (Email)</label>
                <div class="w-full rounded-lg bg-gray-300 text-base px-4 py-2.5">{{ $user->email }}</div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex-grow">
                    <label class="block text-sm text-gray-500 mb-1 select-none">Password</label>
                    <div class="w-full rounded-lg bg-gray-300 text-base px-4 py-2.5">••••••••••</div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Floating Edit Button -->
<div class="fixed bottom-10 right-10">
    <a href="{{ route('rekantani.editprofil') }}" class="bg-[#00c853] text-white font-semibold rounded-full px-7 py-3 text-base flex items-center gap-2 hover:bg-[#00b14a] transition">
        Edit Profil
        <i class="fas fa-pencil-alt"></i>
    </a>
</div>
@if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 1500)" x-show="show" x-cloak x-transition
                class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
                <div class="bg-white rounded-3xl p-8 w-full max-w-md text-center shadow-lg">
                    <h2 class="text-xl font-medium text-gray-700 mb-6">{{ session('success') }}</h2>
                    <div class="flex justify-center">
                        <div class="bg-green-600 rounded-full w-24 h-24 flex items-center justify-center">
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

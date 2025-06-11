@extends('mitra.app')

@section('content')
<div class="flex flex-col md:flex-row justify-between flex-grow px-6 py-10 gap-10 max-w-7xl mx-auto w-full text-base">

    <!-- Left profile card -->
    <section class="bg-white rounded-2xl shadow-md p-8 max-w-lg w-full flex flex-col items-center text-lg">
        <img alt="Foto Profil Agen" class="rounded-xl border border-gray-300 mb-6 w-full object-cover max-h-[240px]" height="240"
            src="{{ asset('storage/' . $agen->foto_profil) }}" width="360" />

        <h2 class="font-extrabold text-2xl text-center mb-2">
            {{ $agen->nama }}
        </h2>
        <p class="text-center text-gray-600 font-semibold text-lg mb-6">
            Agen
        </p>

        <div class="w-full space-y-6">
            <div>
                <label class="block text-sm text-gray-500 mb-2">Nama Lengkap</label>
                <div class="w-full rounded-md bg-gray-300 px-4 py-3 select-text">
                    {{ $agen->nama }}
                </div>
            </div>
            <div>
                <label class="block text-sm text-gray-500 mb-2">Email</label>
                <div class="w-full rounded-md bg-gray-300 px-4 py-3 select-text">
                    {{ $agen->User->email }}
                </div>
            </div>
            <div>
                <label class="block text-sm text-gray-500 mb-2">Alamat</label>
                <div class="w-full rounded-md bg-gray-300 px-4 py-3 select-text whitespace-wrap">
                    {{ $agen->alamat }}
                </div>
            </div>
            <div>
                <label class="block text-sm text-gray-500 mb-2">No WhatsApp</label>
                <div class="w-full rounded-md bg-gray-300 px-4 py-3 select-text">
                    {{ $agen->no_hp }}
                </div>
            </div>
        </div>
    </section>


    <!-- Right account info -->
    <section class="flex flex-col flex-grow max-w-xl w-full space-y-8 text-lg">
        <div class="flex items-center justify-end space-x-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-700 text-white text-base font-semibold rounded-full px-6 py-3 flex items-center gap-2 hover:bg-red-900 transition" type="submit">
                    Logout <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>

            <h3 class="text-xl font-semibold">
                Halo, {{ $agen->nama }}!
            </h3>
            <img alt="Foto Profil Agen" class="w-12 h-12 rounded-full object-cover" src="{{ asset('storage/' . $agen->foto_profil) }}" />
        </div>

        <div class="bg-white rounded-2xl shadow-md p-8 space-y-6">
            <h4 class="font-semibold text-lg">Informasi Akun</h4>
            <div>
                <label class="block text-sm text-gray-500 mb-2">Username (Email)</label>
                <div class="w-full rounded-md bg-gray-300 px-4 py-3 select-text">
                    {{ $agen->user->email }}
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <div class="flex-grow">
                    <label class="block text-sm text-gray-500 mb-2">Password</label>
                    <div class="w-full rounded-md bg-gray-300 px-4 py-3 select-text">
                        ••••••••••
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Floating Button -->
<div class="fixed bottom-8 right-8">
    <a href="{{ route('agen.editprofil') }}" class="bg-[#00c853] text-white text-base font-semibold rounded-full px-6 py-3 flex items-center gap-2 hover:bg-[#00b14a] transition">
        Edit Profil <i class="fas fa-pencil-alt"></i>
    </a>
</div>

@if (session('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 1500)" x-show="show" x-cloak x-transition
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white rounded-3xl p-10 w-full max-w-md text-center shadow-lg text-lg">
            <h2 class="text-2xl font-medium text-gray-700 mb-6">{{ session('success') }}</h2>
            <div class="flex justify-center">
                <div class="bg-green-600 rounded-full w-28 h-28 flex items-center justify-center">
                    <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" stroke-width="3"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

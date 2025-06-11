@extends('admin.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-10 flex flex-col lg:flex-row items-center lg:items-start gap-10 relative z-10 scale-110">

    <section class="flex-1 max-w-xl">
        <div class="inline-flex items-center bg-white rounded-full px-4 py-2 mb-6 mt-7 select-none w-max">
            <p class="text-xs font-semibold">
                Platform Pengajuan Bibit Terbaik !
            </p>
        </div>
        <h1 class="text-4xl sm:text-5xl font-light leading-tight mb-2">
            Selamat Datang,
            <span class="font-extrabold">
                ADMIN
            </span>
            !
        </h1>
        <h2 class="text-4xl sm:text-5xl font-extrabold text-[#1f7a4a] mb-6 leading-tight">
            BibitTanam
        </h2>
        <p class="text-sm sm:text-base text-gray-800 mb-8 leading-relaxed">
            <span class="font-semibold">BibitTanam</span> adalah platform digital yang memudahkan admin memverifikasi akun rekan tani dan agen hortikultura di Jawa Timur. Lewat panel admin, Anda bisa memantau pengajuan, menyetujui akun, serta mengakses fitur penting seperti katalog, riwayat pengajuan, dan broadcast kebutuhan.
                Sebagai pusat kendali sistem, admin memastikan koneksi antara agen dan petani berjalan lancar, pengajuan cepat ditindaklanjuti, dan ketersediaan bibit tetap terjaga.
        </p>
        <a href="" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold rounded-full px-6 py-3 flex items-center gap-2 select-none">
            Verivikasi Akun Sekarang
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        <div class="mt-10 border border-gray-400 rounded-lg p-4 max-w-xs select-none">
            <h3 class="font-semibold mb-2">
                Ringkasan Akun
            </h3>
            <p class="text-sm leading-tight">
                🌾 Rekan Tani Terdaftar: {{ $jumlahRekanTani }}
            </p>
            <p class="text-sm leading-tight">
                👥 Agen Terdaftar: {{ $jumlahAgen }}
            </p>
            <p class="text-sm leading-tight">
                ⏳ Menunggu Verifikasi: {{ $jumlahPending }}
            </p>
        </div>
    </section>

    <section class="relative flex-1 max-w-lg">
        <div class="absolute w-[420px] h-[520px] rounded-full bg-[#d9d9d9]" style="top: 75%; left: 50%; transform: translate(-50%, -50%)"></div>
        <img alt="" class="relative mx-auto translate-y-32" height="420" src="{{ asset('asset/admin.png') }}" width="420"/>
        <div class="absolute top-[40%] left-0 transform -translate-y-1/2 bg-white rounded-full px-4 py-2 text-xs font-normal flex items-center gap-2 max-w-[180px] shadow select-none" style="line-height: 1.1">
            <svg class="h-4 w-4 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Verivikasi Akun
        </div>
        <div class="absolute top-[25%] right-0 transform -translate-y-1/2 bg-white rounded-full px-4 py-2 text-xs font-normal flex items-center gap-2 max-w-[180px] shadow select-none" style="line-height: 1.1">
            <svg class="h-4 w-4 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Mendukung Ketersediaan Beragam Bibit
        </div>
        <div class="absolute bottom-[15%] right-0 transform translate-y-1/2 bg-white rounded-full px-4 py-2 text-xs font-normal flex items-center gap-2 max-w-[140px] shadow select-none" style="line-height: 1.1">
            <svg class="h-4 w-4 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Pantau Aktivitas Sistem
        </div>
    </section>
</div>
@endsection

@extends('mitra.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-16 py-10 flex flex-col-reverse lg:flex-row items-center lg:items-start gap-10 relative z-10">

    {{-- Kiri: Teks --}}
    <section class="flex-1 max-w-xl">
        <div class="inline-flex items-center bg-white rounded-full px-4 py-2 mb-6 mt-7 select-none w-max">
            <p class="text-xs font-semibold">
                Platform Pengajuan Bibit Terbaik !
            </p>
        </div>
        <h1 class="text-4xl sm:text-5xl font-light leading-tight mb-2">
            Selamat Datang,
            <span class="font-extrabold">AGEN</span>!
        </h1>
        <h2 class="text-4xl sm:text-5xl font-extrabold text-[#1f7a4a] mb-6 leading-tight">
            {{ $namaAgen }}
        </h2>
        <p class="text-sm sm:text-base text-gray-800 mb-8 leading-relaxed">
            <span class="font-semibold">BibitTanam</span> adalah platform digital yang memudahkan agen dalam mengajukan kebutuhan bibit hortikultura ke mitra petani terpercaya di Jawa Timur. Lewat sistem pengajuan terintegrasi, Anda bisa kirim permintaan secara real-time, lacak statusnya, dan lakukan pembayaran dengan aman. Akses juga katalog bibit unggulan, broadcast kebutuhan ke banyak mitra sekaligus, dan cek riwayat pengajuan—all dalam satu sistem praktis yang terhubung langsung dengan petani lokal.
        </p>
        <a href="{{ route('v_pengajuan') }}" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold rounded-full px-6 py-3 flex items-center gap-2 select-none">
            Ajukan Bibit Sekarang
            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
        <div class="mt-10 border border-gray-400 rounded-lg p-4 max-w-xs select-none">
            <h3 class="font-semibold mb-2">Ringkasan Aktivitas</h3>
            <p class="text-sm leading-tight">📄 Jumlah Pengajuan Anda: {{ $totalPengajuan }}</p>
            <p class="text-sm leading-tight">✅ Pengajuan Menunggu Persetujuan: {{ $menungguPersetujuan }}</p>
        </div>
    </section>

    {{-- Kanan: Gambar --}}
    <section class="relative flex-1 max-w-lg">
        <div class="absolute w-[360px] h-[460px] rounded-full bg-[#d9d9d9]" style="top: 75%; left: 50%; transform: translate(-50%, -50%)"></div>
        <img alt="" class="relative mx-auto translate-y-32 w-[360px] h-auto" src="{{ asset('asset/foto_agen.png') }}" />

        {{-- Bubble Atas Kiri --}}
        <div class="absolute top-[40%] left-0 transform -translate-y-1/2 bg-white rounded-full px-4 py-2 text-xs font-normal flex items-center gap-2 max-w-[180px] shadow select-none">
            <svg class="h-4 w-4 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Mendapatkan Segala Macam Bibit
        </div>

        {{-- Bubble Atas Kanan --}}
        <div class="absolute top-[25%] right-0 transform -translate-y-1/2 bg-white rounded-full px-4 py-2 text-xs font-normal flex items-center gap-2 max-w-[180px] shadow select-none">
            <svg class="h-4 w-4 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Memperluas Koneksi Rekan Tani
        </div>

        {{-- Bubble Bawah Kanan --}}
        <div class="absolute bottom-[15%] right-0 transform translate-y-1/2 bg-white rounded-full px-4 py-2 text-xs font-normal flex items-center gap-2 max-w-[140px] shadow select-none">
            <svg class="h-4 w-4 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Pengajuan Cepat !
        </div>
    </section>

</div>
@endsection

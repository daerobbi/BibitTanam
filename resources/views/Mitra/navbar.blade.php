<div class="bg-green-700 text-white w-full h-18">
    <div class="flex justify-between items-center px-6 h-full">
        <div class="flex items-center space-x-2 h-full">
            <div class="rounded-full p-1 flex items-center justify-center h-full">
                <img src="{{ asset('asset/logo.png') }}" class="w-14 h-14 scale-150 translate-y-1" alt="Logo">
            </div>
            <span class="font-bold text-xl leading-none">BibitTanam</span>
        </div>

        <nav class="flex items-center space-x-4 text-sm">
            <a href="{{ route('agen.beranda') }}" class="hover:underline">Beranda</a>
            <a href="/agen/pengajuan" class="hover:underline">Cari & ajukan bibit</a>
            <a href="/agen/riwayat-pengajuan" class="hover:underline">Riwayat Pengajuan</a>
            <a href="{{ route('agen.profil') }}" class="hover:underline">Akun</a>
        </nav>
    </div>
</div>

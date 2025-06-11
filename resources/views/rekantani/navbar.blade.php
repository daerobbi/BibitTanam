<div class="bg-green-700 text-white w-full h-18">
    <div class="flex justify-between items-center px-6 h-full">
        <div class="flex items-center space-x-2 h-full">
            <div class="rounded-full p-1 flex items-center justify-center h-full">
                <img src="{{ asset('asset/logo.png') }}" class="w-14 h-14 scale-150 translate-y-1" alt="Logo">
            </div>
            <span class="font-bold text-xl leading-none">BibitTanam</span>
        </div>
        <!-- Kanan: Navigasi -->
        <nav class="flex items-center space-x-4 text-sm">
            <a href="{{ route('rekantani.beranda') }}" class="hover:underline">Beranda</a>
            <a href="/rekantani/katalog" class="hover:underline">Katalog</a>
            <a href="/rekantani/pengajuan" class="hover:underline">Pengajuan Bibit</a>
            <a href="/rekantani/jadwalDistribusi" class="hover:underline">Manajamen Jadwal Distribusi</a>
            <a href="{{ route('profil.rekantani') }}" class="hover:underline">Akun</a>
        </nav>
    </div>
</div>

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
            <a href="{{ route('admin.beranda') }}" class="hover:underline">Beranda</a>
            <a href="{{ route('admin.verifikasi') }}" class="hover:underline">Verifikasi</a>
            <a href="/admin/pengajuan" class="hover:underline">Pengajuan</a>
            <a href="{{ route('admin.agen') }}" class="hover:underline">Agen</a>
            <a href="{{ route('admin.rekantani') }}" class="hover:underline">Rekan Tani</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-semibold py-1 px-3 rounded transition duration-200">
                    LOGOUT
                </button>
            </form>
        </nav>

    </div>
</div>

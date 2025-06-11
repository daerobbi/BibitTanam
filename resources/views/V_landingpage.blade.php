<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>
        BibitTanam
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#e9eaea]">
    <header class="flex justify-between items-center px-6 sm:px-10 md:px-16 lg:px-24 py-6 max-w-[1280px] mx-auto">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('asset/logo_hijau.png') }}" alt="BibitTanam logo with green background and white text"
                class="w-14 h-14" width="56" height="56" />
            <span class="text-3xl font-bold text-[#144d2b] select-none">BibitTanam</span>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('login') }}"
                class="bg-[#1f7a4a] text-white px-5 py-2 rounded-full flex items-center gap-2 text-sm font-semibold hover:bg-[#166032] transition">
                Login
                <i class="fas fa-arrow-right"></i>
            </a>
            <a href="{{ route('register') }}"
                class="bg-[#f2c419] text-black rounded-full px-5 py-2 text-sm font-semibold flex items-center gap-2 hover:brightness-110 transition">
                Register
                <i class="fas fa-sign-in-alt"></i>
            </a>
        </div>
    </header>

    <section class="px-6 sm:px-10 md:px-16 lg:px-20 xl:px-28 pt-6 pb-10 max-w-[1200px] mx-auto">
        <div class="mb-4 inline-flex items-center gap-2 bg-white rounded-full px-3 py-1 shadow-sm">
            <i class="fas fa-star text-[#f2c419]">
            </i>
            <span class="text-xs font-semibold">
                Platform Pengajuan Bibit Terbaik !
            </span>
        </div>
        <h2 class="text-[22px] sm:text-[26px] md:text-[28px] lg:text-[30px] font-light leading-tight max-w-3xl mb-2">
            Ajukan atau Terima Permintaan Bibit ?
        </h2>
        <h1
            class="text-[28px] sm:text-[36px] md:text-[40px] lg:text-[44px] font-extrabold max-w-4xl mb-2 leading-tight">
            Semua Bisa di
            <span class="text-[#1f6f4f]">
                BibitTanam
            </span>
        </h1>
        <p class="text-[#1f6f4f] max-w-3xl text-sm sm:text-base leading-relaxed mb-8">
            Dapatkan bibit sesuai kebutuhanmu atau terima permintaan dari mitra. Semua proses dalam satu platform yang
            menghubungkan petani dan agen secara langsung
        </p>
        <div class="flex flex-col lg:flex-row gap-6 max-w-5xl mx-auto">
            <div class="flex-1 flex flex-col gap-6">
                <div class="bg-[#1f6f4f] rounded-md p-6">
                    <p class="text-[#f2c419] text-xs font-semibold mb-1">
                        Tentang BibitTanam
                    </p>
                    <p class="text-white text-xs sm:text-sm font-semibold leading-snug max-w-3xl">
                        BibitTanam adalah platform digital yang mempertemukan rekan tani dan agen bibit untuk saling
                        terkoneksi, saling mendukung, dan mempercepat proses distribusi bibit tanaman hortikultura. Kami
                        hadir untuk menciptakan ekosistem pertanian yang lebih efisien, transparan, dan saling
                        menguntungkan.
                    </p>
                </div>
                <p class="text-center text-xs mb-6">
                    Bergabung di BibitTanam sebagai :
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                    <div class="bg-white rounded-xl shadow-md p-5 max-w-[320px]">
                        <h3 class="text-[#1f6f4f] font-semibold text-sm mb-3 text-center">
                            Rekan Tani
                        </h3>
                        <ul class="text-xs text-[#4a4a4a] space-y-2">
                            <li class="flex gap-2">
                                <div
                                    class="flex items-center justify-center w-6 h-6 bg-[#b9e6c9] rounded-md text-[#1f6f4f]">
                                    <i class="fas fa-check">
                                    </i>
                                </div>
                                Mengelola stok bibit hortikultura dengan mudah
                            </li>
                            <li class="flex gap-2">
                                <div
                                    class="flex items-center justify-center w-6 h-6 bg-[#b9e6c9] rounded-md text-[#1f6f4f]">
                                    <i class="fas fa-check">
                                    </i>
                                </div>
                                Menyediakan bibit sesuai permintaan agen
                            </li>
                            <li class="flex gap-2">
                                <div
                                    class="flex items-center justify-center w-6 h-6 bg-[#b9e6c9] rounded-md text-[#1f6f4f]">
                                    <i class="fas fa-check">
                                    </i>
                                </div>
                                Menampilkan semua produk bibit yang bisa diajukan oleh agen
                            </li>
                            <li class="flex gap-2">
                                <div
                                    class="flex items-center justify-center w-6 h-6 bg-[#b9e6c9] rounded-md text-[#1f6f4f]">
                                    <i class="fas fa-check">
                                    </i>
                                </div>
                                Mengatur jadwal distribusi
                            </li>
                            <li class="flex gap-2">
                                <div
                                    class="flex items-center justify-center w-6 h-6 bg-[#b9e6c9] rounded-md text-[#1f6f4f]">
                                    <i class="fas fa-check">
                                    </i>
                                </div>
                                Memperluas jangkauan produk ke banyak mitra agen
                            </li>
                        </ul>
                    </div>
                    <div class="bg-white rounded-xl shadow-md p-5 max-w-[320px]">
                        <h3 class="text-[#1f6f4f] font-semibold text-sm mb-3 text-center">
                            Agen
                        </h3>
                        <ul class="text-xs text-[#4a4a4a] space-y-2">
                            <li class="flex gap-2">
                                <div
                                    class="flex items-center justify-center w-6 h-6 bg-[#b9e6c9] rounded-md text-[#1f6f4f]">
                                    <i class="fas fa-check">
                                    </i>
                                </div>
                                Terhubung dengan banyak rekan tani dalam satu platform
                            </li>
                            <li class="flex gap-2">
                                <div
                                    class="flex items-center justify-center w-6 h-6 bg-[#b9e6c9] rounded-md text-[#1f6f4f]">
                                    <i class="fas fa-check">
                                    </i>
                                </div>
                                Mengajukan permintaan bibit langsung ke rekan tani
                            </li>
                            <li class="flex gap-2">
                                <div
                                    class="flex items-center justify-center w-6 h-6 bg-[#b9e6c9] rounded-md text-[#1f6f4f]">
                                    <i class="fas fa-check">
                                    </i>
                                </div>
                                Mencari bibit berdasarkan kategori, jenis, dan lokasi terdekat
                            </li>
                            <li class="flex gap-2">
                                <div
                                    class="flex items-center justify-center w-6 h-6 bg-[#b9e6c9] rounded-md text-[#1f6f4f]">
                                    <i class="fas fa-check">
                                    </i>
                                </div>
                                Membuat broadcast untuk kebutuhan bibit yang sulit ditemukan
                            </li>
                            <li class="flex gap-2">
                                <div
                                    class="flex items-center justify-center w-6 h-6 bg-[#b9e6c9] rounded-md text-[#1f6f4f]">
                                    <i class="fas fa-check">
                                    </i>
                                </div>
                                Menjangkau banyak pilihan bibit dari sumber yang terpercaya
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex-1 flex justify-center items-center">
                <div class="flex-1 flex justify-center items-center">
                    <img alt="Wanita tersenyum memegang kotak kardus berisi sayur dan buah segar seperti selada, pisang, apel, tomat, dan anggur"
                        class="w-[480px] h-[480px] object-contain rounded-md" height="480"
                        src="{{ asset('asset/orangbawabuah.png') }}" width="480" />
                </div>

            </div>
    </section>
    <section class="max-w-[1200px] mx-auto px-6 sm:px-10 md:px-16 lg:px-20 xl:px-28 pb-10">
        <div class="border-t border-gray-300 pt-6">
            <p class="text-center text-xs mb-1">
                Perkembangan
            </p>
            <p class="text-center text-xs font-semibold mb-6">
                Platfrom
                <span class="text-[#1f6f4f]">
                    BibitTanam
                </span>
                Terkini
            </p>
            <div class="flex flex-wrap justify-center gap-8 max-w-5xl mx-auto">
                <div class="flex flex-col items-center w-[80px] sm:w-[100px]">
                    <div
                        class="bg-[#c9f7d9] rounded-full w-[80px] h-[80px] flex items-center justify-center text-[#1f6f4f] text-xl sm:text-2xl font-semibold">
                        30+
                    </div>
                    <p class="text-center text-[10px] sm:text-xs mt-2 leading-tight">
                        Wilayah Jangkauan di Jawa Timur
                    </p>
                </div>
                <div class="flex flex-col items-center w-[80px] sm:w-[100px]">
                    <div
                        class="bg-[#c9f7d9] rounded-full w-[80px] h-[80px] flex items-center justify-center text-[#1f6f4f] text-xl sm:text-2xl font-semibold">
                        70+
                    </div>
                    <p class="text-center text-[10px] sm:text-xs mt-2 leading-tight">
                        Rekan Tani Terverifikasi
                    </p>
                </div>
                <div class="flex flex-col items-center w-[80px] sm:w-[100px]">
                    <div
                        class="bg-[#c9f7d9] rounded-full w-[80px] h-[80px] flex items-center justify-center text-[#1f6f4f] text-xl sm:text-2xl font-semibold">
                        50+
                    </div>
                    <p class="text-center text-[10px] sm:text-xs mt-2 leading-tight">
                        Agen Terverifikasi
                    </p>
                </div>
                <div class="flex flex-col items-center w-[80px] sm:w-[100px]">
                    <div
                        class="bg-[#c9f7d9] rounded-full w-[80px] h-[80px] flex items-center justify-center text-[#1f6f4f] text-xl sm:text-2xl font-semibold">
                        800+
                    </div>
                    <p class="text-center text-[10px] sm:text-xs mt-2 leading-tight">
                        Pengajuan Bibit Terkirim
                    </p>
                </div>
                <div class="flex flex-col items-center w-[80px] sm:w-[100px]">
                    <div
                        class="bg-[#c9f7d9] rounded-full w-[80px] h-[80px] flex items-center justify-center text-[#1f6f4f] text-xl sm:text-2xl font-semibold">
                        100+
                    </div>
                    <p class="text-center text-[10px] sm:text-xs mt-2 leading-tight">
                        Produk Bibit Tersedia
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="max-w-[1200px] mx-auto px-6 sm:px-10 md:px-16 lg:px-20 xl:px-28 pb-20 relative">
        <div aria-hidden="true" class="absolute -left-40 -top-20 w-[400px] h-[400px] rounded-full bg-[#f2c419] -z-10">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-4xl mx-auto">
            <div class="flex gap-4 items-center bg-white rounded-xl p-4 max-w-[320px]">
                <div class="bg-[#f7d6a9] rounded-xl p-2 flex-shrink-0">
                    <img alt="Foto close-up jahe, kunyit, temulawak, dan herbal lainnya di atas meja kayu"
                        class="rounded-lg w-[100px] h-[80px] object-cover" height="80"
                        src="https://storage.googleapis.com/a1aa/image/9664f36b-029f-4924-1c73-554220cec70b.jpg"
                        width="100" />
                </div>
                <div>
                    <h4 class="font-extrabold text-sm mb-1">
                        Tanaman Herbal
                    </h4>
                    <p class="text-xs text-[#4a4a4a] leading-tight max-w-[180px]">
                        Bibit jahe, kunyit, temulawak, dan herbal lainnya untuk kebutuhan industri dan rumah tangga.
                    </p>
                </div>
            </div>
            <div class="flex gap-4 items-center bg-white rounded-xl p-4 max-w-[320px]">
                <div class="bg-[#c3d6a3] rounded-xl p-2 flex-shrink-0">
                    <img alt="Foto sayuran kangkung, bayam, sawi segar di kebun"
                        class="rounded-lg w-[100px] h-[80px] object-cover" height="80"
                        src="https://storage.googleapis.com/a1aa/image/fa193f21-1aa3-4e4f-4931-b1c212bacd4f.jpg"
                        width="100" />
                </div>
                <div>
                    <h4 class="font-extrabold text-sm mb-1">
                        Sayuran
                    </h4>
                    <p class="text-xs text-[#4a4a4a] leading-tight max-w-[180px]">
                        Bibit kangkung, bayam, sawi, dan jenis sayuran daun dan buah untuk budidaya cepat panen.
                    </p>
                </div>
            </div>
            <div class="flex gap-4 items-center bg-white rounded-xl p-4 max-w-[320px]">
                <div class="bg-[#f2c419] rounded-xl p-2 flex-shrink-0">
                    <img alt="Foto buah mangga, jeruk, pisang segar dalam keranjang"
                        class="rounded-lg w-[100px] h-[80px] object-cover" height="80"
                        src="https://storage.googleapis.com/a1aa/image/4d9f32d2-8dd9-4931-3580-1d59196561d6.jpg"
                        width="100" />
                </div>
                <div>
                    <h4 class="font-extrabold text-sm mb-1">
                        Buah Buahan
                    </h4>
                    <p class="text-xs text-[#4a4a4a] leading-tight max-w-[180px]">
                        Bibit mangga, jeruk, pisang, dan buah musiman lainnya untuk lahan dan pekarangan.
                    </p>
                </div>
            </div>
            <div class="flex gap-4 items-center bg-white rounded-xl p-4 max-w-[320px]">
                <div class="bg-[#e7a1b1] rounded-xl p-2 flex-shrink-0">
                    <img alt="Foto bunga hias merah segar dengan latar belakang hijau"
                        class="rounded-lg w-[100px] h-[80px] object-cover" height="80"
                        src="https://storage.googleapis.com/a1aa/image/e0a02e00-1c19-493b-f584-df1b18d8cd6e.jpg"
                        width="100" />
                </div>
                <div>
                    <h4 class="font-extrabold text-sm mb-1">
                        Tanaman Hias
                    </h4>
                    <p class="text-xs text-[#4a4a4a] leading-tight max-w-[180px]">
                        Berbagai jenis bibit bunga dan tanaman estetika untuk dekorasi dan koleksi.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-[#1f7a4a] text-white mt-20 sm:mt-24 md:mt-28 lg:mt-32">
        <div
            class="max-w-[1280px] mx-auto px-6 sm:px-10 md:px-16 lg:px-24 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="space-y-4 max-w-[350px]">
                <h2 class="text-2xl font-light leading-tight">
                    Bersama <span class="font-bold">BibitTanam</span>,<br />
                    Kuatkan Ekosistem<br />
                    Tani Lokal
                </h2>
                <a href="{{ route('register') }}"
                    class="border border-white rounded-full px-5 py-2 text-xs font-light flex items-center gap-2 hover:bg-white hover:text-[#1f7a4a] transition w-max">
                    Bergabung Sekarang <i class="fas fa-arrow-right"></i>
                </a>
            </div>


            <div class="space-y-4 max-w-[350px]">
                <h2 class="text-2xl font-light leading-tight">
                    Kolaborasi.<br />
                    Kemandirian.<br />
                    Keberlanjutan.
                </h2>
                <p class="text-xs font-light max-w-[250px]">
                    " Kami percaya pertanian Indonesia bisa tumbuh lewat kerja sama yang
                    adil dan transparan"
                </p>
            </div>

            <div class="space-y-4 max-w-[350px] text-xs">
                <h3 class="font-bold uppercase tracking-widest">GET IN TOUCH</h3>
                <ul class="space-y-2">
                    <li class="flex items-center gap-2">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:BibitTanam@mail.com" class="hover:underline">BibitTanam@mail.com</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-phone"></i>
                        <a href="tel:+6287790909090" class="hover:underline">+6287790909090</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fab fa-whatsapp"></i>
                        <a href="https://wa.me/087712446280" class="hover:underline">wa.me/087712446280</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fab fa-instagram"></i>
                        <a href="https://instagram.com/BibitTanam.id" class="hover:underline">BibitTanam.id</a>
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="border-t border-white/30 max-w-[1280px] mx-auto px-6 sm:px-10 md:px-16 lg:px-24 py-4 text-xs flex justify-between text-white/70">
            <span>
                <strong>BibitTanam</strong> © 2025. SEMUA HAK DILINDUNGI.<br />
                JL. TANI MAKMUR NO. 5, LUMAJANG, JAWA TIMUR – INDONESIA
            </span>
            <span>
                Oleh Tim <strong>BibitTanam</strong>
            </span>
        </div>
    </footer>
</body>

</html>

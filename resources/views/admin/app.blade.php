<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'BibitTanam' }}</title>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans flex flex-col min-h-screen">

    {{-- Navbar --}}
    @include('admin.navbar')

    {{-- Main Content --}}
    <main class="flex-1">
        @yield('content')
    </main>
<footer class="bg-[#1f7a4a] text-white mt-20 sm:mt-24 md:mt-28 lg:mt-32">
        <div
        class="max-w-[1280px] mx-auto px-6 sm:px-10 md:px-16 lg:px-24 py-12 grid grid-cols-1 md:grid-cols-3 gap-8"
        >
        <div class="space-y-4 max-w-[350px]">
            <h2 class="text-2xl font-light leading-tight">
                Bersama <span class="font-bold">BibitTanam</span>,<br />
                Kuatkan Ekosistem<br />
                Tani Lokal
            </h2>
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
                <a href="mailto:BibitTanam@mail.com" class="hover:underline"
                >BibitTanam@mail.com</a
                >
            </li>
            <li class="flex items-center gap-2">
                <i class="fas fa-phone"></i>
                <a href="tel:+6287790909090" class="hover:underline">+6287790909090</a>
            </li>
            <li class="flex items-center gap-2">
                <i class="fab fa-whatsapp"></i>
                <a href="https://wa.me/087712446280" class="hover:underline"
                >wa.me/087712446280</a
                >
            </li>
            <li class="flex items-center gap-2">
                <i class="fab fa-instagram"></i>
                <a href="https://instagram.com/BibitTanam.id" class="hover:underline"
                >BibitTanam.id</a
                >
            </li>
            </ul>
        </div>
        </div>

        <div
        class="border-t border-white/30 max-w-[1280px] mx-auto px-6 sm:px-10 md:px-16 lg:px-24 py-4 text-xs flex justify-between text-white/70"
        >
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

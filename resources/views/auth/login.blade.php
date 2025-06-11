<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>BibitTanam Login</title>
    <link rel="icon" href="{{ asset('asset/logo.png') }}" type="image/x-icon" />
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body class="bg-[#e3e3e3] min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Background shapes -->
    <div class="absolute -left-[40vw] -top-[40vw] w-[90vw] h-[90vw] rounded-full bg-white"></div>
    <div class="absolute right-0 top-1/2 -translate-y-1/2 w-[50vw] h-[50vw] rounded-full bg-[#1b6f4a]"></div>
    <div class="absolute right-16 bottom-16 w-36 h-36 rounded-full bg-[#f5c518]"></div>

    <!-- Main content -->
    <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between max-w-7xl w-full px-6 md:px-12 py-20 gap-10">
        <!-- Left text block -->
        <div class="flex flex-col max-w-lg text-center lg:text-left">
            <h1 class="text-[4rem] sm:text-[5rem] lg:text-[7rem] font-extrabold leading-tight text-[#042a1b] drop-shadow-[2px_2px_1px_rgba(0,0,0,0.3)] mb-6">
                BibitTanam
            </h1>
            <p class="text-base font-normal max-w-sm mx-auto lg:mx-0">
                Login sebagai Agen atau Rekan,<br />
                <strong class="font-extrabold text-black">
                    untuk mengakses semua fitur <span class="text-[#1b6f4a]">BibitTanam !</span>
                </strong>
            </p>
        </div>

        <!-- Login form -->
        <div class="bg-white rounded-[2rem] shadow-[4px_4px_6px_rgba(0,0,0,0.1)] w-full max-w-md p-10">
            <h2 class="text-center text-lg font-semibold mb-8">Log In</h2>
            <form method="POST" action="{{ route('login') }}" class="flex flex-col space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block mb-1 text-sm text-[#6b7280]">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="w-full border border-[#1b6f4a] rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1b6f4a]"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block mb-1 text-sm text-[#6b7280]">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        autocomplete="current-password"
                        class="w-full border border-[#1b6f4a] rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#1b6f4a]"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <button
                    type="submit"
                    class="bg-[#1b6f4a] text-white rounded-md py-2 mt-2 hover:bg-[#165a3a] transition-colors"
                >
                    Log in
                </button>
            </form>

            <p class="text-center text-xs text-[#1a1a1a] mt-6">
                Belum mempunyai akun?
                <a href="{{ route('register') }}" class="text-[#1b6f4a] hover:underline">Tekan disini untuk Registrasi</a>
            </p>
        </div>
    </div>

    <!-- Flash messages -->
    @if (session('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2500)" x-show="show" x-transition
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
            <div class="bg-white rounded-3xl p-8 w-full max-w-md text-center shadow-lg">
                <h2 class="text-xl font-medium text-gray-700 mb-6">{{ session('error') }}</h2>
                <div class="flex justify-center">
                    <div class="bg-red-600 rounded-full w-24 h-24 flex items-center justify-center">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" stroke-width="3"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2500)" x-show="show" x-cloak x-transition
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
</body>
</html>

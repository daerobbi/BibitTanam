<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>BibitTanam Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
        rel="stylesheet" />
    <style>body{font-family:"Inter",sans-serif}</style>
</head>
<body class="relative bg-[#e3e3e3] min-h-screen overflow-x-hidden">

    {{-- Background dekorasi --}}
    <div class="absolute -top-[40%] -left-[40%] w-[1200px] h-[1200px] rounded-full bg-white"></div>
    <div class="absolute top-[50%] right-0 w-[900px] h-[900px] rounded-full bg-[#1b7a4a] -translate-y-1/2"></div>
    <div class="absolute bottom-10 right-20 w-40 h-40 rounded-full bg-[#f5c518] shadow-lg"></div>

    <main class="relative max-w-[1400px] mx-auto px-6 py-20 flex flex-col lg:flex-row items-center lg:items-start gap-10">

        {{-- Left text --}}
<div class="flex-1 min-w-[300px] lg:max-w-[450px] order-1 lg:order-none z-10">
            <h1 class="text-[85px] font-extrabold leading-none text-[#042a1f] drop-shadow-[2px_2px_0_rgba(0,0,0,0.15)]">
                BibitTanam
            </h1>
            <p class="mt-6 text-lg text-[#1a1a1a]">
                Daftarkan akun Anda sebagai Rekan Tani atau Agen,
                <strong>untuk mulai menggunakan layanan
                    <span class="text-[#1b7a4a]">BibitTanam!</span></strong>
            </p>
        </div>

        {{-- Form --}}
        <form
            action="{{ route('register.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="bg-white rounded-3xl shadow-lg p-10 w-full flex-1 min-w-[320px] z-10"
            aria-label="Register"
        >
            @csrf
            <h2 class="text-xl font-bold text-center mb-8">Register</h2>

            {{-- Tampilkan error validasi --}}
            @if($errors->any())
                <div class="mb-6 bg-red-100 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc pl-5 space-y-1 text-sm">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-6">

                {{-- Kolom 1 --}}
                <div class="flex flex-col space-y-4">
                    <label class="text-sm text-[#6b7280]">Nama</label>
                    <input name="nama" value="{{ old('nama') }}" required
                            class="border border-[#1b7a4a] rounded px-3 py-2 focus:ring-[#1b7a4a] focus:outline-none">

                    <label class="text-sm text-[#6b7280]">Alamat</label>
                    <input name="alamat" value="{{ old('alamat') }}" required
                            class="border border-[#1b7a4a] rounded px-3 py-2 focus:ring-[#1b7a4a] focus:outline-none">

                    <label class="text-sm text-[#6b7280]">Kota Domisili</label>
                    <select name="kota" required
                            class="border border-[#1b7a4a] rounded px-3 py-2 bg-white focus:ring-[#1b7a4a] focus:outline-none">
                        <option value="">Pilih Kota</option>
                        @foreach($kota as $k)
                            <option value="{{ $k->id }}" {{ old('kota')==$k->id?'selected':'' }}>
                                {{ $k->nama_kota }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Kolom 2 --}}
                <div class="flex flex-col space-y-4">
                    <label class="text-sm text-[#6b7280]">No. WhatsApp</label>
                    <input type="number" name="whatsapp" value="{{ old('whatsapp') }}" required
                            class="border border-[#1b7a4a] rounded px-3 py-2 focus:ring-[#1b7a4a] focus:outline-none">

                    <label class="text-sm text-[#6b7280]">Email</label>
                    <input name="email" type="email" value="{{ old('email') }}" required
                            class="border border-[#1b7a4a] rounded px-3 py-2 focus:ring-[#1b7a4a] focus:outline-none">

                    <label class="text-sm text-[#6b7280]">Password</label>
                    <input name="password" type="password" required
                            class="border border-[#1b7a4a] rounded px-3 py-2 focus:ring-[#1b7a4a] focus:outline-none">

                    <label class="text-sm text-[#6b7280]">Konfirmasi Password</label>
                    <input name="password_confirmation" type="password" required
                            class="border border-[#1b7a4a] rounded px-3 py-2 focus:ring-[#1b7a4a] focus:outline-none">
                </div>

                {{-- Kolom 3 --}}
                <div class="flex flex-col space-y-4">
                    <label class="text-sm text-[#6b7280]">Daftar Sebagai</label>
                    <select name="daftar" required
                            class="border border-[#1b7a4a] rounded px-3 py-2 bg-white focus:ring-[#1b7a4a] focus:outline-none">
                        <option value="">Pilih Peran</option>
                        <option value="rekantani" {{ old('daftar')=='rekantani'?'selected':'' }}>Rekan Tani</option>
                        <option value="agen" {{ old('daftar')=='agen'?'selected':'' }}>Agen</option>
                    </select>

                    <p class="text-xs text-[#6b7280] mt-1">*Unduh dan lengkapi dokumen berikut:</p>
                    <a href="{{ asset('asset/DOKUMEN_PENDAFTARAN.docx') }}"
                        class="text-[#1b7a4a] text-sm border border-[#1b7a4a] rounded px-3 py-1 inline-block hover:bg-[#1b7a4a] hover:text-white transition">
                        template_bukti_usaha.docx
                    </a>

                    <label class="text-xs text-[#6b7280] mt-4">*Unggah dokumen yang telah dilengkapi:</label>
                    <input type="file" name="dokumen_verifikasi" required
                            class="border border-[#1b7a4a] rounded px-3 py-2 text-sm file:mr-3 file:py-1 file:px-3 file:border-0 file:bg-[#2ecc71] file:text-white file:rounded file:cursor-pointer">
                </div>
            </div>

            <div class="mt-8 flex flex-col items-center">
                <button type="submit"
                        class="bg-[#0b4d2f] text-white rounded px-8 py-2 w-40 hover:bg-[#0a3f26] transition">
                    Register
                </button>
                <p class="mt-4 text-sm text-[#1a1a1a]">
                    Sudah mempunyai akun?
                    <a href="{{ route('login') }}" class="text-[#1b7a4a] hover:underline">Tekan disini untuk Login</a>
                </p>
            </div>
        </form>
    </main>
</body>
</html>

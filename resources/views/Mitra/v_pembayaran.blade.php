@extends('Mitra.app')
@section('content')

<!-- Grid Layout: Sidebar dan Konten Utama -->
<div class="grid grid-cols-4 gap-6">

    <!-- Sidebar -->
    <aside class="col-span-1 bg-gray-200 p-6 flex flex-col items-center shadow-md min-h-full">
        <img src="{{ asset('storage/' .$pengajuan->bibit->rekanTani->foto_profil)}}" alt="Petani" class="rounded-full w-40 h-40 object-cover mb-4">
        <h2 class="text-xl font-bold mb-2">{{ $pengajuan->bibit->rekanTani->nama ?? '-' }}</h2>
        <p class="text-sm text-gray-600 mb-1">Lokasi : {{ $pengajuan->bibit->rekanTani->kota->nama_kota ?? '-' }}</p>
        <p class="text-sm text-gray-600 text-center mb-4">Jenis Bibit : {{ $pengajuan->bibit->jenisBibit->jenis_bibit ?? '-' }}</p>
        <p class="text-sm text-gray-600 text-center mb-1">Kontak : {{ $pengajuan->bibit->rekanTani->no_hp }}</p>
        <p class="text-sm text-gray-600 text-center mb-1">Alamat : {{ $pengajuan->bibit->rekanTani->alamat }}</p>
    </aside>

    <!-- Invoice & Upload Section -->
    <section class="col-span-3 grid grid-cols-2 gap-6 mt-6"> <!-- Menambahkan margin-top di sini -->
        <div>
            <h2 class="text-xl font-semibold mb-4">Tagihan</h2>
            <div class="border p-6 rounded-lg">
                <img src="{{ asset('storage/'.$pengajuan->foto_invoice) }}" alt="Invoice" class="w-full rounded-lg shadow-md">
            </div>
        </div>

        <div class="flex flex-col justify-between items-center border border-gray-300 rounded-lg p-6">
            <form id="uploadForm" action="{{ route('agen.uploadbukti', $pengajuan->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col justify-between items-center w-full">
                @csrf
                <div class="flex flex-col items-center justify-center h-full w-full">
                    <!-- Preview Bukti Bayar (Gambar jika ada, atau kosong) -->
                    <img id="previewImage" src="{{ $pengajuan->bukti_bayar ? asset('storage/'.$pengajuan->bukti_bayar) : '' }}" alt="upload icon" class="mb-4 w-full rounded-lg shadow-md {{ $pengajuan->bukti_bayar ? '' : 'hidden' }}">
                    <p class="text-gray-500">Silahkan Upload Bukti Transfer</p>

                    <!-- Sembunyikan input file jika bukti_bayar sudah ada -->
                    @if(!$pengajuan->bukti_bayar)
                        <input type="file" id="fileInput" name="bukti_transfer" accept="image/*,.pdf" class="mt-4">
                    @endif
                </div>

                <!-- Sembunyikan tombol Kirim jika bukti_bayar sudah ada -->
                @if(!$pengajuan->bukti_bayar)
                    <button id="submitBtn" type="submit" class="mt-6 bg-gray-400 text-white px-6 py-2 rounded-full font-semibold hover:bg-gray-500">Kirim</button>
                @endif
            </form>
        </div>
    </section>

</div>

<script>
    const fileInput = document.getElementById('fileInput');
    const previewImage = document.getElementById('previewImage');
    const submitBtn = document.getElementById('submitBtn');

    // Menampilkan preview gambar setelah memilih file
    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden'); // Menampilkan gambar setelah dipilih
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection

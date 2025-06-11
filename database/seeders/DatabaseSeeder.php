<?php

namespace Database\Seeders;

use App\Models\JenisBibit; // Pastikan Anda sudah menggunakan model JenisBibit
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan beberapa jenis bibit dengan benar
        JenisBibit::create(['jenis_bibit' => 'buah']);
        JenisBibit::create(['jenis_bibit' => 'sayuran']);
        JenisBibit::create(['jenis_bibit' => 'tanaman hias']);
        JenisBibit::create(['jenis_bibit' => 'tanaman herbal']);
    }
}



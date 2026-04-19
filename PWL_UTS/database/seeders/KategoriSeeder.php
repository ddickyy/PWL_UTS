<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_kategori')->insert([
            ['kategori_kode' => 'KTG01', 'kategori_nama' => 'Makanan'],
            ['kategori_kode' => 'KTG02', 'kategori_nama' => 'Minuman'],
            ['kategori_kode' => 'KTG03', 'kategori_nama' => 'Camilan'],
        ]);
    }
}

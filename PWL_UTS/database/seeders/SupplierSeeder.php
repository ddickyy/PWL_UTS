<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_supplier')->insert([
            [
                'supplier_kode' => 'SUP01',
                'supplier_nama' => 'PT Jaya Selamanya',
                'supplier_alamat' => 'Surabaya'
            ],
            [
                'supplier_kode' => 'SUP02',
                'supplier_nama' => 'CV Sumber Abadi',
                'supplier_alamat' => 'Jakarta'
            ],
                [
                    'supplier_kode' => 'SUP03',
                    'supplier_nama' => 'UD Makmur Sentosa',
                    'supplier_alamat' => 'Bandung'
                ],
        ]);
    }
}

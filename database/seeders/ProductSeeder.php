<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\productsModel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uuid1 = Str::uuid();
        $uuid2 = Str::uuid();
        $datas = [
            ['id' => $uuid1,
            'kode_produk' => 'P-001',
            'nama_produk' => 'Nasi Goreng Telur',
            'gambar' => 'P-001.jpg',
            'harga' => 15000,
            'deskripsi' => 'nasi yang digoreng dengan telur'],
            ['id' => $uuid2,
            'kode_produk' => 'P-002',
            'nama_produk' => 'Nasi Kremes',
            'gambar' => 'P-002.jpg',
            'harga' => 18000,
            'deskripsi' => 'nasi rames dengan tambahan telur dadar']
        ];
        foreach($datas as $data){
            productsModel::create($data);
        }
    }
}

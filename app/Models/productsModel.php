<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productsModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'gambar',
        'harga',
        'tersedia',
        'deskripsi'
    ];
    protected $table = 'products';
}

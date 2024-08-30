<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use App\Models\transactionsModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class productsModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'gambar',
        'harga',
        'deskripsi'
    ];
    protected $table = 'products';

    public function transaction_data()
    {
        return $this->hasOne(transactionsModel::class, 'id_product', 'id');
    }
}

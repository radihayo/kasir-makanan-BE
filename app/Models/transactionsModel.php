<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionsModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'kode_produk',
        'jumlah',
        'tanggal_transaksi',
        'waktu_transaksi',
        'pegawai_melayani',
        'keterangan'
    ];
    protected $table = 'transactions';

}

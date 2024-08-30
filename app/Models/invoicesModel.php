<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use App\Models\transactionsModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class invoicesModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    // const UPDATED_AT = null;
    // const CREATED_AT = null;
    protected $fillable = [
        // 'id',
        'pegawai_melayani',
        'tanggal_transaksi',
        'waktu_transaksi',
        'total'
    ];
    protected $table = 'invoices';

    public function transaction_data()
    {
        return $this->hasMany(transactionsModel::class, 'id_invoice', 'id');
    }
}

<?php

namespace App\Models;

use App\Models\invoicesModel;
use App\Models\productsModel;
use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class transactionsModel extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $fillable = [
        'jumlah_sub_total',
        'keterangan',
        'id_product',
        'id_invoice'
    ];
    protected $table = 'transactions';
    public function product_data()
    {
        return $this->belongsTo(productsModel::class, 'id_product', 'id');
    }
}

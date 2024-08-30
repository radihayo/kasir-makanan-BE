<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\invoicesModel;
use App\Models\productsModel;
use App\Models\transactionsModel;
use App\Http\Resources\transactionsResource;

class transactionsController extends Controller
{
    public function show(){
        $dataTransactions = invoicesModel::with('transaction_data.product_data:id,kode_produk,nama_produk,gambar,harga,deskripsi')->get();
        return transactionsResource::collection($dataTransactions);
    }

    public function store(Request $request){
        if($request->total && $request->pegawai_melayani && $request->tanggal_transaksi && $request->waktu_transaksi){
            $storeInvoice = invoicesModel::create([
                'pegawai_melayani' => $request->pegawai_melayani,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'waktu_transaksi' => $request->waktu_transaksi,
                'total' => $request->total 
            ]);
        }else{
            $lastInsertInvoice = invoicesModel::latest()->first();
            $getDataProduct = productsModel::where('kode_produk', $request->kode_produk)->firstOrFail();
            $storeTransaction = transactionsModel::create([
                'jumlah_sub_total' => $request->jumlah_sub_total,
                'keterangan' => $request->keterangan,
                'id_product' => $getDataProduct->id,
                'id_invoice' => $lastInsertInvoice->id
            ]);
        }
        return response()->json(['message' => 'Store Data Transaction Successfully'],200);
    }
}

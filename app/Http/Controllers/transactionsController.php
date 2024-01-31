<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\transactionsModel;
use App\Http\Resources\transactionsResource;
use App\Http\Resources\transactionDetailResource;

class transactionsController extends Controller
{
    public function show(){
        try {
            $dataTransactions = transactionsModel::all();
            return transactionsResource::collection($dataTransactions);
        } catch (Exception $e) {
            return response()->json(['message' => 'Not found'], 404);
        }
        
    }
    
    public function detail($id){
        try {
            $dataDetailProduct = transactionsModel::findOrFail($id);
            return new transactionDetailResource($dataDetailProduct);
        } catch (Exception $e) {
            return response()->json(['message' => 'Not found'], 404);
        }
    }

    public function store(Request $request){
        $validated = $request->validate([
            'kode_produk' => 'required',
            'jumlah' => 'required',
            'tanggal_transaksi' => 'required',
            'waktu_transaksi' => 'required',
            'pegawai_melayani' => 'required',
            'status' => 'required'
        ]);
        $store = transactionsModel::create($request->all());
        return new transactionDetailResource($store);
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'status' => 'required'
        ]);
        $update = transactionsModel::findOrFail($id);
        $update->update([
            'status' => $request->status
        ]);
        return new transactionDetailResource($update);
    }

    public function destroy($id)
    {
        $destroy = transactionsModel::findOrFail($id);
        $destroy->delete();
        return new transactionDetailResource($destroy);
    }
}

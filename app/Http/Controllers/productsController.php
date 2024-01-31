<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\productsModel;
use App\Http\Resources\productsResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\productDetailResource;

class productsController extends Controller
{
    public function show(){
        $dataProducts = productsModel::all();
        return productsResource::collection($dataProducts);
    }
    
    public function detail($id){
        $dataDetailProduct = productsModel::findOrFail($id);
        return new productDetailResource($dataDetailProduct);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'kode_produk' => 'required|unique:products,kode_produk',
            'nama_produk' => 'required|max:50',
            'harga' => 'required|numeric',
            'tersedia' => 'required'
        ]);
        $store = productsModel::create($request->all());
        return new productDetailResource($store);
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'kode_produk' => 'required|unique:products,kode_produk,'. $id,
            'nama_produk' => 'required|max:50',
            'harga' => 'required|numeric',
            'tersedia' => 'required'
        ]);
        $update = productsModel::findOrFail($id);
        $update->update($request->all());
        return new productDetailResource($update);
    }

    public function destroy($id)
    {
        $destroy = productsModel::findOrFail($id);
        $destroy->delete();
        return new productDetailResource($destroy);
    }
}

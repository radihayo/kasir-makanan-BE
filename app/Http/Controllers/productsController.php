<?php

namespace App\Http\Controllers;

use App\Models\nyobakModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\productsModel;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\productsResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\productStoreRequest;
use App\Http\Requests\productUpdateRequest;


class productsController extends Controller
{
    public function show(){
        $dataProducts = productsModel::orderBy('kode_produk', 'asc')->get();
        return productsResource::collection($dataProducts);
    }
    
    public function store(productStoreRequest $request){
        if($request->file == ''){
            $fileName = 'default.jpg';           
        }else{
            $fileName = uniqid().'.jpg';            
            Storage::putFileAs('image/products/',$request->file,$fileName);            
        };
        $request['gambar'] = $fileName;
        $store = productsModel::create($request->all());
        return response()->json(['message'=>'Store Data Product Successfully'],201);
    }

    public function update(productUpdateRequest $request, $id){
        $getDataProduct = productsModel::findOrFail($id);
        if($request->file == ''){
            $getDataProduct->update($request->all());
        }else{
            $fileName = uniqid().'.jpg';
            if($getDataProduct->gambar == 'default.jpg'){
                Storage::putFileAs('image/products/',$request->file,$fileName);
                $request['gambar'] = $fileName;
                $getDataProduct->update($request->all());
            }else{
                Storage::delete('image/products/'.$getDataProduct->gambar);
                Storage::putFileAs('image/products/',$request->file,$fileName);
                $request['gambar'] = $fileName;
                $getDataProduct->update($request->all());
            }
        }
        return response()->json(['message'=>'Update Data Product Successfully'],200);  
    }

    public function destroy($id)
    {
        $getDataProduct = productsModel::findOrFail($id);
        if($getDataProduct->gambar == 'default.jpg'){
            $getDataProduct->delete();
        }else{
            Storage::delete('image/products/'.$getDataProduct->gambar);
            $getDataProduct->delete();
        }
        return response()->json(['message'=>'Destroy Data Product Successfully'],200);
    }
}

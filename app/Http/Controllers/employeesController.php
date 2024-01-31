<?php

namespace App\Http\Controllers;

use App\Models\roleModel;
use App\Models\usersModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\employeesModel;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\employeesResource;
use App\Http\Resources\employeeDetailResource;

class employeesController extends Controller
{
    public function show(){
        $dataEmployees = employeesModel::all();
        return employeesResource::collection($dataEmployees);
    }

    public function detail($id){
        $dataDetailEmployees = employeesModel::findOrFail($id);
        return new employeeDetailResource($dataDetailEmployees);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nama' => 'required|max:50|unique:employees,nama',
            'email' => 'required|unique:employees,email',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|max:50',
            'agama' => 'required',
            'no_telp' => 'required|size:12',
            'alamat' => 'required|max:50'
        ]);
        $uuid = Str::uuid();
        $store = employeesModel::create([
            'id' => $uuid,
            'nama'=> $request->nama,
            'email'=> $request->email,
            'jenis_kelamin'=> $request->jenis_kelamin,
            'tempat_lahir'=> $request->tempat_lahir,
            'tanggal_lahir'=> $request->tanggal_lahir,
            'agama'=> $request->agama,
            'no_telp'=> $request->no_telp,
            'alamat'=> $request->alamat,
        ]);

        $data_role = roleModel::where('role', 'user')->firstOrFail();
        usersModel::create([
            'username' => $request->email,
            'password' => Hash::make($request->no_telp),
            'id_role' => $data_role->id,
            'id_employee' => $uuid
        ]);

        return new employeeDetailResource($store);
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'nama' => 'required|max:50|unique:employees,nama,'. $id,
            'email' => 'required|unique:employees,email,'. $id,
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|max:50',
            'agama' => 'required',
            'no_telp' => 'required|size:12',
            'alamat' => 'required|max:50'
        ]);
        $update = employeesModel::findOrFail($id);
        $update->update($request->all());
        return new employeeDetailResource($update);
    }

    public function destroy(Request $request, $id)
    {
        $email = $request->email;
        $data_role = usersModel::where('username', $email)->firstOrFail();
        usersModel::where('id', $data_role->id)->delete();

        $destroy = employeesModel::findOrFail($id);
        $destroy->delete();
        return new employeeDetailResource($destroy);
    }
}

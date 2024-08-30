<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\roleModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\employeesModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\employeesResource;
use App\Http\Requests\employeeStoreRequest;
use App\Http\Requests\employeeUpdateRequest;
use App\Http\Requests\employeePasswordRequest;

class employeesController extends Controller
{
    public function show(){
        $dataEmployees = employeesModel::all();
        $dataEmployeesOnlyUser = employeesModel::with('data_users.role_data')
        ->join('users','users.id_employee','=','employees.id')
        ->join('role','role.id','=','users.id_role')
        ->where('role','=','user')
        ->select('employees.*')
        ->orderBy('nama', 'asc')
        ->get();
        return employeesResource::collection($dataEmployeesOnlyUser);
    }

    public function store(employeeStoreRequest $request){
        if($request->file == ''){
            $fileName = 'default.jpg';
        }else{
            $fileName = uniqid().'.jpg';
            Storage::putFileAs('image/profile/',$request->file,$fileName);
        };

        $uuidEmployee = Str::uuid();
        $request['id'] = $uuidEmployee;
        $request['foto'] = $fileName;
        $storeEmployee = employeesModel::create($request->all());

        $getDataRole = roleModel::where('role', 'user')->firstOrFail();
        $uuidUser = Str::uuid();
        $storeUser = User::create([
            'id' => $uuidUser,
            'username' => $request->email,
            'password' => Hash::make('user'),
            'id_role' => $getDataRole->id,
            'id_employee' => $uuidEmployee
        ]);
        return response()->json(['message'=>'Store Data Employee Successfully'],200);
    }

    public function update(employeeUpdateRequest $request, $id){
        $getDataEmployee = employeesModel::findOrFail($id);
        $data = [
            'username' => $request->email
        ];
        User::where('id_employee', $id)->update($data);
        if($request->file == ''){
            $getDataEmployee->update($request->all());
        }else{
            $fileName = uniqid().'.jpg';
            if($getDataEmployee->foto == 'default.jpg'){
                Storage::putFileAs('image/profile/',$request->file,$fileName);
                $request['foto'] = $fileName;
                $getDataEmployee->update($request->all());   
            }else{
                Storage::delete('image/profile/'.$getDataEmployee->foto);
                Storage::putFileAs('image/profile/',$request->file,$fileName);
                $request['foto'] = $fileName;
                $getDataEmployee->update($request->all());
            }
        }
        return response()->json(['message'=>'Update Data Employee Successfully'],200); 
    }

    public function destroy($id)
    {
        User::where('id_employee',$id)->delete();

        $getDataEmployee = employeesModel::findOrFail($id);
        if($getDataEmployee->foto == 'default.jpg'){
            $getDataEmployee->delete();
        }else{
            Storage::delete('image/profile/'.$getDataEmployee->foto);
            $getDataEmployee->delete();
        }
        return response()->json(['message'=>'Destroy Data Employee Successfully'],200); 
    }

    public function change_password(employeePasswordRequest $request, $id)
    {
        $data = [
            'password'     => Hash::make($request->new_password)
        ];
        $dataUpdate = User::where('id_employee',$id)->update($data);
        return response()->json(['message'=>'Change Password Employee Successfully'],200); 
    }

    public function reset_password(Request $request, $id)
    {
        $data = [
            'password'     => Hash::make($request->password_reset)
        ];
        $dataUpdate = User::where('id_employee',$id)->update($data);
        return response()->json(['message'=>'Reset Password Employee Successfully'],200); 
    }

}

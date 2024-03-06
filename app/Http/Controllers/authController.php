<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\usersModel;
use Illuminate\Http\Request;
use App\Http\Requests\loginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class authController extends Controller
{
    public function login(loginRequest $request){
        // $request->validate([
        //     'username' => 'required',
        //     'password' => 'required',
        // ]);

        $user = User::where('username', $request->username)->first();
        $data_user_selected = usersModel::where('username',$request->username)->firstOrFail();
        // $data_user = usersModel::with('employee_data')->where('email',$request->username)->get();
        $complete_data_user = usersModel::with(['employee_data:id,nama,email,jenis_kelamin,tempat_lahir,tanggal_lahir,agama,no_telp,alamat','role_data:id,role'])->findOrFail($data_user_selected->id);
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken($request->username)->plainTextToken;

        return response()->json([
            'user' => $complete_data_user,
            'access_token' => $token,
            'token_type'=>'Bearer'
        ]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Log out success'], 200);
    }
}

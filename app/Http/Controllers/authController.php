<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\loginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class authController extends Controller
{
    public function login(loginRequest $request){
        $user = User::where('username', $request->username)->firstOrFail();
        $completeDataUser = User::with(['employee_data:id,nama,email,jenis_kelamin,tempat_lahir,tanggal_lahir,foto,agama,no_telp,alamat','role_data:id,role'])->where('username',$request->username)->firstOrFail();
        if ( $user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken($request->username)->plainTextToken;
            return response()->json([
                'message' => 'Success',
                'data' => $completeDataUser,
                'access_token' => $token,
                'token_type'=>'Bearer'
            ],200);
        }else{
            return response()->json([
                'message'=>'Failed'
            ],404);
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Log out success'], 200);
    }
}

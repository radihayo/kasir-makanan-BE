<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\sendCodeResetPassword;
use App\Models\forgotPasswordModel;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\forgotPasswordRequest;

class forgotPasswordController extends Controller
{
    public function forgot_password(forgotPasswordRequest $request){
        // $codeForReset = mt_rand(100000, 999999);
        // Mail::to($request->email)->send(new OtpMail($codeForReset));
        // $request['code'] = $codeForReset;
        // forgotPasswordModel::create($request->all());
        // $getUserRequestForgotPassword = User::where('username', $request->username)->firstOrFail();
        // $forgotPasswordLinkSend = $getUserRequestForgotPassword->sendPasswordResetLink();
        forgotPasswordModel::where('email', $request->username)->delete();
        $code = mt_rand(100000, 999999);
        forgotPasswordModel::create([
            'email' => $request->username,
            'code' => $code
        ]);

        Mail::to($request->username)->send(new sendCodeResetPassword($code));
        return response()->json(['message'=>'Code Was Sent Successfully'], 200);
    }
}

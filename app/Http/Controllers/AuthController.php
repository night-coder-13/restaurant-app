<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SendOtpToUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginform()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'cellphone' => ['required', 'regex:/^^09[0-9]{9}$/']
        ]);

        $user = User::where('cellphone', $request->cellphone)->first();
        $otp = mt_rand(111111, 999999);
        $logintoken = Hash::make('reza$jetcom*qwsdc');

        try {
            if ($user) {
                $user->update([
                    'otp' => $otp,
                    'login_token' => $logintoken,
                ]);
            } else {
                $user = User::create([
                    'cellphone' => $request->cellphone,
                    'otp' => $otp,
                    'login_token' => $logintoken,
                ]);
            }

            // // $user->mobile = '09902774517';
            // $user->notify(new SendOtpToUser());

            return response()->json(['message' => 'Done !', 'login_token' => $logintoken], 200);
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
    public function checkOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
            'login_token' => 'required',
        ]);


        try {
            $user = User::where('login_token', $request->login_token)->firstOrFail();
            
            if($user->otp == $request->otp){
                Auth::login($user , $remember = true);
                return response()->json(['message' => 'ورود با موفقیت انجام شد !'], 200);
            }else{
                return response()->json(['message' => 'کد ورود نادرست است .'], 200);

            }
        } catch (Exception $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }
}

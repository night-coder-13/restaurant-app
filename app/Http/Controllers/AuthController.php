<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginform(){
        return view('auth.login');
    }
    public function login(Request $request){
        $request->validate([
            'cellphone' => ['required' , 'regex:/^^09[0-9]{9}$/']
        ]);
        return response()->json(['message' => 'Done!']);
    }
}

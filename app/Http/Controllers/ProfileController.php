<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('profile.index' , compact('user'));
    }

    public function update(Request $request , User $user){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email,'.$user->id,
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return redirect()->route('profile.index')->with('success' , 'ویرایش با موفقیت انجام شد');
    }
}

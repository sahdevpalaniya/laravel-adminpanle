<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $data = [];
        $data['form_heading'] = "Register Your Self";
        $data['page_title'] = "Register Form";
        return view('admin.auth.register', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        
        $users = new User();
        $users->name=$request['name'];
        $users->email=$request['email'];
        $users->role=1;
        $users->password=Hash::make($request['password']);
        $users->save();
        
        return redirect()->route('login')->with('success', 'You Are Register SuccessFully');
    }
}

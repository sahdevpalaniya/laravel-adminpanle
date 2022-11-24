<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class LoginContoller extends Controller
{
    public function index()
    {
        $data = [];
        $data['form_heading'] = "Sign in your account";
        $data['page_title'] = "Admin Login";
        return view('admin.auth.login')->with($data);
    }

    public function user_check(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $users = User::where('email', '=', $request->email)->first();
        if ($users) {
            if (Hash::check($request->password, $users->password)) {
                $request->session()->put('userid', $users->id);
                $request->session()->put('useremail', $users->email);
                $request->session()->put('username', $users->name);
                $request->session()->put('userrole', $users->role);
                return redirect()->route('admin-dashboard');
            } else {
                return back()->with('error', 'Password has been wrong');
            }
        } else {
            return back()->with('error', 'Check Your E-mail');
        }
    }

    public function logout()
    {
        if (session()->has('userid')) {
            session()->forget('userid');
            session()->forget('useremail');
            session()->forget('username');
            session()->forget('userrole');
            return redirect('/')->with('success', 'You Are logout SuccessFully');
        }
    }

    public function forgotpass()
    {
        $data = [];
        $data['form_heading'] = "Forgot Password";
        $data['page_title'] = "Forgot Password";
        return view('admin.auth.fogotPass')->with($data);
    }

    public function send_email(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $users = User::where('email', '=', $request->email)->first();
        if ($users) {
            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now(),
            ]);
            Mail::send('admin.auth.mail', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });
            return redirect()->route('forgotpass')->with('success', 'E-mail has been sent successfully');
        } else {
            return back()->with('error', 'Please check your e-mail address');
        }
    }

    public function reset_password($token)
    {
        $data = [];
        $data['form_heading'] = 'Change Password';
        $data['page_title'] = 'Change Password';
        $data['tokendata'] = DB::table('password_resets')->where('token', '=', $token)->first();
        return view('admin.auth.resetpass', ['token' => $token])->with($data);
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        $users = User::where('email', '=', $request->email)->update(['password' => Hash::make($request->password)]);
        if ($users) {
            return redirect()->route('login')->with('success', 'Your Password Has Been Change Successfully');
        } else {
            return redirect()->route('login')->with('error', 'Password was not change try again');
        }
    }
}

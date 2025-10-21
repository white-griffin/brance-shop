<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {

        return view('auth.admin.login');
    }

    public function login()
    {
        $this->loginValidate();
        $admin = Admin::where('username', request('username'))->first();

        if (Hash::check(request('password'), $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('error', 'اطلاعات ورود صحیح نمیباشد');

    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.auth.login.form');
    }


    public function loginValidate()
    {
        request()->validate([
            'username' => ['required', 'exists:admins'],
            'password' => ['required'],
        ], [
            'username.required' => 'وارد کردن نام کاربری الزامی است ',
            'password.required' => 'وارد کردن پسورد الزامی است ',
        ]);
    }
}

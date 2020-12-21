<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    public function showLoginForm() {
        return view('admin.auth.login');
    }

    public function login(Request $request) {
        if (Auth::guard('admin')->attempt(
            ['email' => $request->email, 'password' => $request->password],  $request->remember
        )) {
            // Authenticate success
            \Toastr::success('Xin chào');
            return redirect()->route('admin.dashboard');
        }
        // Authenticate fail
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('msg','Email hoặc Mật khẩu không chính xác');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        // Redirect to Admin Login
        \Toastr::success('Đăng xuất thành công');
        return redirect()->route('admin.login');
    }
}

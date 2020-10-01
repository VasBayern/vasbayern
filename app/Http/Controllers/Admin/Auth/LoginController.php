<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $this->validate($request, array(
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ), [
            'password.min' => 'Mật khẩu có ít nhất 8 kí tự',
        ]);

        if (Auth::guard('admin')->attempt(
            ['email' => $request->email, 'password' => $request->password],  $request->remember
        )) {
            // Authenticate success
            \Toastr::success('Xin chào');
            return redirect()->route('admin.dashboard');
        }
    
        // Authenticate fail
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('msg','Email hoặc mật khẩu không chính xác');
    }

    public function logout() {
        Auth::guard('admin')->logout();

        // chuyển hướng về trang login của admin
        \Toastr::success('Đăng xuất thành công');
        return redirect()->route('admin.login');
    }
}

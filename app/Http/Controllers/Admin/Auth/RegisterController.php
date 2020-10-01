<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use Illuminate\Http\Request;

class RegisterController extends Controller {

    public function __construct()
    {
        $this->middleware('auth:admin')->only('index');
    }
    
    public function showRegisterForm() {
        return view('admin.auth.register');
    }
    
    public function register(Request $request) {
        
        $this->validate($request, array(
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ), [
            'email.unique' => 'Email đã tồn tại',
            'password.confirmed' => 'Mật khẩu không khớp',
            'password.min' => 'Mật khẩu có ít nhất 8 kí tự',
        ]);
        $adminModel = new AdminModel();

        $adminModel->name = $request->name;
        $adminModel->email = $request->email;
        $adminModel->password = bcrypt($request->password);
        $adminModel->save();

        return redirect()->route('admin.login');

    }
}

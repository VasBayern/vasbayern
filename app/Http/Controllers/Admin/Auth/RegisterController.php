<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\AdminModel;
use App\Models\User;
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
        $admin = new User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->role = 0;
        $admin->save();
        return redirect()->route('admin.login');
    }
}

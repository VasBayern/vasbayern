<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        return view('frontend.user.profile');
    }

    public function updateProfile(Request $request)
    {
        // đổi mật khẩu
        if (!empty($_POST['check'])) {
            if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
                // sai mật khẩu cũ
                \Toastr::error('Sai mật khẩu');
                return redirect()->back()->with('error', 'Mật khẩu hiện tại của bạn không đúng');
            }
            if (strcmp($request->get('old_password'), $request->get('new_password')) == 0) {
                // trùng mật khẩu cũ
                \Toastr::error('Sai mật khẩu');
                return redirect()->back()->with('error', 'Mật khẩu mới không được trùng với mật khẩu cũ');
            }
        }
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->extension();
            $avatar->move(public_path('/front_ends/img/user_avatar'), $avatarName);
        }
        $item = Auth::user();
        $item->name         = $request->name;
        if (isset($request->new_password)) {
            $item->password = bcrypt($request->get('new_password'));
        }
        if (isset($avatar)) {
            $item->avatar   = $avatarName;
        }
        $item->save();
        \Toastr::success('Cập nhật thành công');
        return redirect()->back();
    }

    public function editAddress()
    {
        $data = array();
        $user_id = Auth::id();
        $customers = CustomerModel::where('user_id', $user_id)->get();
        $data['customers'] = $customers;
        return view('frontend.user.address', $data);
    }

    public function storeAddress(Request $request)
    {
        $input          = $request->all();
        $id             = DB::table('customers')->max('id');
        $item           = new CustomerModel();
        $item->id       = $id + 1;
        $item->name     = $input['name'];
        $item->user_id  = Auth::user()->id;
        $item->phone    = $input['phone'];
        $item->city     = $input['city'];
        $item->district = $input['district'];
        $item->ward     = $input['ward'];
        $item->address  = $input['address'];
        $item->note     = $input['note'];
        $default        = !empty($_POST['check']) ? 1 : 0;
        $item->default  = $default;
        $item->save();

        if ($default == 1) {
            CustomerModel::where('id', '!=', $id + 1)->update(array('default' => 0));
        }
        \Toastr::success('Thêm thành công');
        return redirect()->back();
    }

    public function updateAddress(Request $request)
    {
        $item           = CustomerModel::find($request->id);
        $item->name     = $request->name;
        $item->user_id  = Auth::user()->id;
        $item->phone    = $request->phone;
        $item->city     = $request->city;
        $item->district = $request->district;
        $item->ward     = $request->ward;
        $item->address  = $request->address;
        $item->note     = $request->note;
        $default        = !empty($_POST['check']) ? 1 : 0;
        $item->default  = $default;
        $item->save();

        if ($default == 1) {
            CustomerModel::where('id', '!=', $request->id)->update(array('default' => 0));
        }
        \Toastr::success('Sửa thành công');
        return redirect()->back();
    }

    public function deleteAddress($id)
    {
        $item = CustomerModel::find($id);
        $item->delete();
        \Toastr::success('Xóa thành công');
        return redirect()->back();
    }
}

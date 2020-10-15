<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index() {
        return view('frontend.user.profile');
    }

    // public function updateProfile(Request $request)
    // {
    //     //có đổi mật khẩu
    //     if (!empty($_POST['check'])) {
    //         $validatedData = $request->validate([
    //             'name' => ['required', 'string', 'max:255'],
    //             'old_password' => ['required', 'string', 'min:8'],
    //             'new_password' => ['required', 'string', 'min:8'],
    //             'confirm_password' => ['required', 'string', 'min:8'],
    //         ], [
    //             'name.required' => 'Bạn phải nhập tên',
    //             'old_password.required' => 'Bạn phải nhập mật khẩu cũ',
    //             'new_password.required' => 'Bạn phải nhập mật khẩu mới',
    //             'confirm_password.required' => 'Bạn phải nhập mật khẩu xác thực',
    //             'old_password.min' => 'Mật khẩu có ít nhất 8 kí tự',
    //             'new_password.min' => 'Mật khẩu có ít nhất 8 kí tự',
    //             'confirm_password.min' => 'Mật khẩu có ít nhất 8 kí tự',
    //         ]);
    //         if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
    //             // sai mật khẩu cũ
    //             $response = ['msg' => 'wrong old password']; 
    //         } elseif (strcmp($request->get('old_password'), $request->get('new_password')) == 0) {
    //             // trùng mật khẩu cũ
    //             $response = ['msg' => 'wrong new password']; 
    //         } elseif ($request->get('confirm_password') != $request->get('new_password')) {
    //             // xác thực không trùng mật khẩu
    //             $response = ['msg' => 'wrong verify password']; 
    //         } else {
    //             // nếu có đổi ảnh
    //             if ($request->hasFile('image')) {
    //                 $validatedData = $request->validate([
    //                     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //                 ], [
    //                     'image.image' => 'Bạn phải nhập ảnh',
    //                     'image.mimes' => 'Định dạng không cho phép',
    //                     'image.max' => 'Kích thước file quá lớn',
    //                 ]);
    //                 $image = $request->file('image');
    //                 $image_name = time() . '.' . $image->getClientOriginalExtension();
    //                 $destinationPath = public_path('/front-ends/img/user-image');
    //                 $image->move($destinationPath, $image_name);
    //                 $user = Auth::user();
    //                 $user->name = $request->name;
    //                 $user->password = bcrypt($request->get('new_password'));
    //                 $user->image = $image_name;
    //                 $user->save();
    //             }else {
    //             $user = Auth::user();
    //             $user->name = $request->name;
    //             $user->password = bcrypt($request->get('new_password'));
    //             $user->save();
    //             }
    //             $response = ['msg' => 'success']; 
    //         }
    //     } else {
    //     // nếu chỉ đổi tên ko đổi mật khẩu
            
    //         // nếu có đổi ảnh
    //         if ($request->hasFile('image')) {
    //             $validatedData = $request->validate([
    //                 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //             ], [
    //                 'image.image' => 'Bạn phải nhập ảnh',
    //                 'image.mimes' => 'Định dạng không cho phép',
    //                 'image.max' => 'Kích thước file quá lớn',
    //             ]);
    //             $image = $request->image;
    //             $image_name = time() . '.' . $image->getClientOriginalExtension();
    //             $destinationPath = public_path('/front-ends/img/user-image');
    //             $image->move($destinationPath, $image_name);
    //             $user = Auth::user();
    //             $user->name = $request->name;
    //             $user->image = $image_name; 
    //             $user->save();

    //         }else {
    //             $user = Auth::user();
    //             $user->name = $request->name;
    //             $user->save();
    //         }

    //         $response = ['msg' => 'success']; 
    //     }
    //     echo \GuzzleHttp\json_encode($response);     
    // }

    public function updateProfile(Request $request)
    {
        //có đổi mật khẩu
        if (!empty($_POST['check'])) {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'old_password' => ['required', 'string', 'min:8'],
                'new_password' => ['required', 'string', 'min:8'],
                'confirm_password' => ['required', 'string', 'min:8', 'same:new_password'],
            ], [
                'name.required' => 'Bạn phải nhập tên',
                'old_password.required' => 'Bạn phải nhập mật khẩu cũ',
                'new_password.required' => 'Bạn phải nhập mật khẩu mới',
                'confirm_password.required' => 'Bạn phải nhập mật khẩu xác thực',
                'old_password.min' => 'Mật khẩu có ít nhất 8 kí tự',
                'new_password.min' => 'Mật khẩu có ít nhất 8 kí tự',
                'confirm_password.min' => 'Mật khẩu có ít nhất 8 kí tự',
                'confirm_password.same' => 'Mật khẩu xác thực không khớp',
            ]);
            if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
                // sai mật khẩu cũ
                return redirect()->back()->with('error', 'Mật khẩu hiện tại của bạn không đúng');

            }
            if (strcmp($request->get('old_password'), $request->get('new_password')) == 0) {
                // trùng mật khẩu cũ
                return redirect()->back()->with('error', 'Mật khẩu mới không được trùng với mật khẩu cũ');
            } else {
                // nếu có đổi ảnh
                if ($request->hasFile('image')) {
                    $validatedData = $request->validate([
                        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ], [
                        'image.image' => 'Bạn phải nhập ảnh',
                        'image.mimes' => 'Định dạng không cho phép',
                        'image.max' => 'Kích thước file quá lớn',
                    ]);
                    $image = $request->file('image');
                    $image_name = time() . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/front-ends/img/user-image');
                    $image->move($destinationPath, $image_name);
                    $user = Auth::user();
                    $user->name = $request->name;
                    $user->password = bcrypt($request->get('new_password'));
                    $user->image = $image_name;
                    $user->save();
                }else {
                $user = Auth::user();
                $user->name = $request->name;
                $user->password = bcrypt($request->get('new_password'));
                $user->save();
                }
                \Toastr::success('Đổi mật khẩu thành công');
                return redirect()->back();
            }
        } else {
            // nếu chỉ đổi tên ko đổi mật khẩu
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ], [
                'name.required' => 'Bạn phải nhập tên',
            ]);
            // nếu có đổi ảnh
            if ($request->hasFile('image')) {
                $validatedData = $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ], [
                    'image.image' => 'Bạn phải nhập ảnh',
                    'image.mimes' => 'Định dạng không cho phép',
                    'image.max' => 'Kích thước file quá lớn',
                ]);
                $image = $request->file('image');
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/front_ends/img/user-image');
                $image->move($destinationPath, $image_name);
                $user = Auth::user();
                $user->name = $request->name;
                $user->image = $image_name;
                $user->save();
            }else {
                $user = Auth::user();
                $user->name = $request->name;
                $user->save();
            }
            \Toastr::success('Cập nhật thành công');
            return redirect()->back();
        }
    }

    public function editAddress() {
        $data = array();
        $user_id = Auth::id();
        $customers = CustomerModel::where('user_id',$user_id)->get();
        $data['customers'] = $customers;
        return view('frontend.user.address',$data);
    }

    public function storeAddress(Request $request) {
        $input = $request->all();
        $id = DB::table('customers')->max('id');

        $item = new CustomerModel();
        $item->id = $id+1;
        $item->name = $input['name'];
        $item->user_id = Auth::user()->id;
        $item->phone = $input['phone'];
        $item->city = $input['city'];
        $item->district = $input['district'];
        $item->ward = $input['ward'];
        $item->address = $input['address'];
        $item->note = $input['note'];
        $default = !empty($_POST['check']) ? 1 : 0;
        $item->default = $default;
        $item->save();
    
        if($default == 1) {
            CustomerModel::where('id', '!=', $id+1)->update(array('default' => 0));
        }
        \Toastr::success('Thêm thành công' );
        return redirect()->back();
    }

    public function updateAddress(Request $request) {

        $item = CustomerModel::find($request->id);
        $item->name = $request->name;
        $item->user_id = Auth::user()->id;
        $item->phone = $request->phone;
        $item->city = $request->city;
        $item->district = $request->district;
        $item->ward = $request->ward;
        $item->address = $request->address;
        $item->note = $request->note;
        $default = !empty($_POST['check']) ? 1 : 0;
        $item->default = $default;
        $item->save();
        
        if($default == 1) {
            CustomerModel::where('id', '!=', $request->id)->update(array('default' => 0));
        }
        // $id = $request->id;
        // $name = $request->name;
        // $phone = $request->phone;
        // $address = $request->address . ', ' . $request->ward . ', ' . $request->district . ', ' . $request->city;

        // $response = [
        //     'id'      => $id,
        //     'name'    => $name,
        //     'address' => $address,
        //     'phone'   => $phone,
        //     'default' => $default,
        //     'msg'     => 'success'
        // ];
        // echo \GuzzleHttp\json_encode($response);     
        \Toastr::success('Sửa thành công' );
        return redirect()->back();
    }

    public function deleteAddress($id) {
        $item = CustomerModel::find($id);
       
        $item->delete();
        \Toastr::success('Xóa thành công');
        return redirect()->back();
    }

    public function editModal(Request $request) {

        $id = $request->id;
        $sql = DB::table('customers')->where('id', $id)->get();
        foreach($sql as $row) {
            $response = [
                'id' => $row->id,
                'name' => $row->name,
                'phone' => $row->phone,
                'city' => $row->city,
                'district' => $row->district,
                'ward' => $row->ward,
                'address' => $row->address,
                'note' => $row->note,
                'default' => $row->default
            ];
        }
        return response($response);

    }

}

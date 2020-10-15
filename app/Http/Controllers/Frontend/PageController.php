<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CommentContactModel;
use App\Models\NewsletterModel;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function getFaq() {
        return view('frontend.content.faq');
    }

    public function getContact() {
        return view('frontend.content.contact');
    }

    public function comment(Request $request) {
        $validatedData = $request->validate([
            'comment' => 'required',
            'email' => 'required|email'
        ],[
            'comment.required' => 'Bạn chưa bình luận',
        ]);

        $input = $request->all();
        $item = new CommentContactModel();

        $item->name = $input['name'];
        $item->email = $input['email'];
        $item->comment = $input['comment'];
        $item->status = 0;
        $item->save();

        \Toastr::success('Vui lòng chờ email phản hồi','Gửi thành công' );
        return redirect()->back();
    }

    public function followBlog(Request $request) {
        $validatedData = $request->validate([
            'email' => 'email'
        ],[
            'email.email' => 'Bạn phải nhập email',
        ]);
        $input = $request->all();
        if(NewsletterModel::where('email', '=', $input['email'])->exists()) {
            \Toastr::error('Vui lòng nhập email khác','Email này đã được đăng ký' );
        } else {
            $item = new NewsletterModel();
            $item->email = $input['email'];
            $item->save();
            \Toastr::success('Hệ thống sẽ gửi tin mới nhất qua email của bạn','Đăng kí thành công' );
        }
        return redirect()->back();
    }
}

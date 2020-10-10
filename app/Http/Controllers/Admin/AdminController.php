<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommentContactModel;
use App\Models\CommentModel;
use App\Models\NewsletterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function getSlug(Request $request) {
        $slug = Str::slug($request->name, '-');
        return response()->json([ 'slug' => $slug ]);
    }

    public function getNewsletters() {
        $users = NewsletterModel::all();
        $data = array();
        $data['users'] = $users;
        return view('admin.content.newsletter.index', $data);
    }

    public function deleteNewsletter($id) {
        $item = NewsletterModel::find($id);
        $item->delete();
        \Toastr::success('Xóa thành công');
        return redirect()->route('newsletters');
    }

    public function getContact() {
        $comments = CommentContactModel::all();
        $data = array();
        $data['comments'] = $comments;
        return view('admin.content.contact.index', $data);
    }

    public function getFeedback() {
        $comments = CommentModel::all();
        $data = array();
        $data['comments'] = $comments;
        return view('admin.content.shop.feedback.index', $data);
    }
}

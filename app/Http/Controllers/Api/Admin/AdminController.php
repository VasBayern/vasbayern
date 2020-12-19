<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommentContactModel;
use App\Models\CommentModel;
use App\Models\NewsletterModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }
    
    public function getSlug(Request $request)
    {
        $slug = Str::slug($request->name, '-');
        return response()->json(['slug' => $slug]);
    }

    public function checkRecordExist($name, $inputName, $table, $field)
    {
        return DB::select('SELECT ' . $field . ' FROM ' . $table . ' WHERE ' . $field . ' != "' . $name . '" AND name = "' . $inputName . '"');
    }

    public function getNewsletter() {
        $users = NewsletterModel::all();
        $data = array();
        $data['users'] = $users;
        return view('admin.content.newsletter.index', $data);
    }

    public function deleteNewsletter($id) {
        $item = NewsletterModel::find($id);
        $item->delete();
        $response = [
            'success'   => true,
            'id'        => $item->id,
        ];
        return response()->json($response, 200);
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
        return view('admin.shop.feedback.index', $data);
    }
}

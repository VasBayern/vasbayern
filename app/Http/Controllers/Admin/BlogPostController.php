<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategoryModel;
use App\Models\BlogPostModel;
use App\Models\NewsletterModel;
use App\Notifications\NewPostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPostModel::orderBy('created_at', 'desc')->get();
        $data = array();
        $data['posts'] = $posts;

        return view('admin.content.blog.post.index', $data);
    }

    public function create()
    {
        $data = array();
        $categories = BlogCategoryModel::all();
        $data['categories'] = $categories;

        return view('admin.content.blog.post.add', $data);
    }
    
    public function edit($slug)
    {
        $data = array();
        $post = BlogPostModel::where('slug', $slug)->first();
        $data['post'] = $post;
        $categories = BlogCategoryModel::all();
        $data['categories'] = $categories;

        return view('admin.content.blog.post.edit', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'          => 'unique:content_post',
            'slug'          => 'unique:content_post',
            'intro' => 'required',
            'desc' => 'required',
        ], [
            'name.unique'   => 'Bài viết đã tồn tại',
            'slug.unique'   => 'Slug đã tồn tại',
            'intro.required' => 'Bạn phải nhập giới thiệu',
            'desc.required' => 'Bạn phải nhập nội dung',
        ]);

        $input              =   $request->all();
        $post               =   new BlogPostModel();
        $post->name         =   ucwords($input['name']);
        $post->slug         =   $input['slug'];
        $post->image        =   $input['image'];
        $post->intro        =   $input['intro'];
        $post->desc         =   $input['desc'];
        $post->category_id  =   $input['category_id'];
        $post->author_id    =   Auth::id();
        $post->view         =   0;
        $post->save();

        $users = NewsletterModel::all();
        foreach ($users as $user) {
            $user->notify(new NewPostNotification($post));
        }
        \Toastr::success('Đã gửi mail tới khách hàng', 'Thêm thành công');
        return redirect()->route('admin.blog.post');
    }

    public function update(Request $request, $slug)
    {
        $validatedData = $request->validate([
            'intro' => 'required',
            'desc' => 'required',
        ], [
            'intro.required' => 'Bạn phải nhập giới thiệu',
            'desc.required' => 'Bạn phải nhập nội dung',
        ]);

        $input              =   $request->all();
        $item               =   BlogPostModel::where('slug', $slug)->first();
        $item->name         =   ucwords($input['name']);
        $item->slug         =   $input['slug'];
        $item->image        =   $input['image'];
        $item->intro        =   $input['intro'];
        $item->desc         =   $input['desc'];
        $item->category_id  =   $input['category_id'];
        $item->author_id    =   Auth::id();
        $item->view         =   0;
        $item->save();

        \Toastr::success('Sửa thành công');
        return redirect()->route('admin.blog.post');
    }

    public function destroy($slug)
    {

        $item = BlogPostModel::where('slug', $slug)->first();
        $item->delete();

        \Toastr::success('Xóa thành công');
        return redirect()->route('admin.blog.post');
    }
}

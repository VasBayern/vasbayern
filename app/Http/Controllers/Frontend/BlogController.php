<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategoryModel;
use App\Models\BlogCommentModel;
use App\Models\BlogPostModel;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() {
        $data = array();
        $categories = BlogCategoryModel::all();
        $data['categories']=$categories;
        $posts = BlogPostModel::orderBy('created_at', 'desc')->paginate(4);
        $data['posts'] = $posts;
        return view('frontend.content.blog', $data);
    }

    public function getBlogCategory($slug) {
        $data = array();
        $categories = BlogCategoryModel::all();
        $data['categories']=$categories;

        $category = BlogCategoryModel::where('slug', $slug)->first();
        $data['category']=$category;

        $posts = BlogPostModel::where('category_id', $category->id)->orderBy('created_at', 'desc')->paginate(4);
        $data['posts'] = $posts;

        return view('frontend.content.blog_category', $data);
    }

    public function getBlogPost($slug) {
        $data = array();
        $post = BlogPostModel::where('slug', $slug)->first();
        $data['post'] = $post;

        $recent_posts = BlogPostModel::where('id' , '!=', $post->id)->orderBy('created_at', 'desc')->take(4)->get();
        $data['recent_posts'] = $recent_posts;

        $comments = BlogCommentModel::where('post_id', $post->id)->orderBy('created_at', 'desc')->get();
        $data['comments'] = $comments;

        $count_cmt = BlogCommentModel::where('post_id', $post->id)->count();
        $data['count_cmt'] = $count_cmt;

        return view('frontend.content.blog_post', $data);
    }

    public function commentBlog(Request $request) {
        $validatedData = $request->validate([
            'comment' => 'required',
        ],[
            'comment.required' => 'Bạn chưa đánh giá',
        ]);

        $input = $request->all();
        $item = new BlogCommentModel();

        $item->user_id = \Auth::id();
        $item->post_id = $input['post_id'];
        $item->comment = $input['comment'];
        $item->save();

        \Toastr::success('Bình luận thành công');
        return redirect()->back();
    }

    public function searchByName(Request $request) {
        $search = $request->search;
        $postBlogs = BlogPostModel::where('name', 'like', '%' .$search. '%')->take(4)->get();
        $response = array();
        foreach ($postBlogs as $key=>$value) {
            $response[] = ["name" => $value->name];
        }
        return response()->json($response);
    }
}

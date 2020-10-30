<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategoryModel;
use App\Models\BlogCommentModel;
use App\Models\BlogPostModel;
use App\Models\TagModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        $data = array();
        $categories = BlogCategoryModel::all();
        $data['categories'] = $categories;
        $posts = BlogPostModel::orderBy('created_at', 'desc')->get();
        $data['posts'] = $posts;
        $tags = TagModel::where('tag_type', 2)->get();
        $data['tags'] = $tags;
        return view('frontend.content.blog', $data);
    }

    public function getBlogPost($slug)
    {
        $data = array();
        $post = BlogPostModel::where('slug', $slug)->first();
        $data['post'] = $post;

        $recent_posts = BlogPostModel::where('id', '!=', $post->id)->orderBy('created_at', 'desc')->take(4)->get();
        $data['recent_posts'] = $recent_posts;

        $comments = BlogCommentModel::where('post_id', $post->id)->orderBy('created_at', 'desc')->get();
        $data['comments'] = $comments;

        $count_cmt = BlogCommentModel::where('post_id', $post->id)->count();
        $data['count_cmt'] = $count_cmt;

        $sql = DB::select('SELECT A.id, A.slug
        FROM tags AS A
        JOIN taggables AS B ON A.id = B.tag_id
        JOIN content_post AS C ON B.post_id = C.id
        WHERE A.tag_type = 2 AND C.id = ' . $post->id);
        $data['tags'] = $sql;

        return view('frontend.content.blog_post', $data);
    }

    public function filter(Request $request)
    {
        $input = $request->dataPost;

        $sql = 'SELECT MAX(A.id) AS id, MAX(A.name) AS name, MAX(A.slug) AS slug, MAX(A.image) AS image, MAX(A.updated_at) AS updated_at,
        MAX(D.name) AS cat_name, MAX(A.intro) AS intro, MAX(A.category_id) AS category_id
        FROM content_post AS A
        JOIN taggables AS B ON A.id = B.post_id
        JOIN tags AS C ON B.tag_id = C.id
        JOIN content_category AS D ON A.category_id = D.id
        WHERE 1=1 ';

        if (isset($input)) {
            foreach ($input as $key => $value) {
                switch ($key) {
                    case 0:
                        $sql .= ' AND ';
                        foreach ($value as $key => $categoryID) {
                            if (!next($value)) {
                                $sql .= ' category_id = ' . $categoryID;
                            } else {
                                $sql .= ' category_id = ' . $categoryID . ' OR ';
                            }
                        }
                        break;
                    case 1:
                        $sql .= ' AND ';
                        foreach ($value as $key => $tagID) {
                            if (!next($value)) {
                                $sql .= ' tag_id = ' . $tagID;
                            } else {
                                $sql .= ' tag_id = ' . $tagID . ' OR ';
                            }
                        }
                        break;
                    default:
                        break;
                }
            }
        }
        $sql .= ' GROUP BY A.updated_at';
        $exec = DB::select($sql);
        $filterPost = [];
        foreach ($exec as $row) {
            $filter = [
                'id'        => $row->id,
                'name'      => $row->name,
                'link'      => url('blogs/post/' . $row->slug),
                'image'     => $row->image,
                'cat_name'  => $row->cat_name,
                'updated_at' => date("d-m-Y", strtotime($row->updated_at)),
                'intro'     => $row->intro,
            ];
            array_push($filterPost, $filter);
        }
        $response = array_values($filterPost);
        return response($response);
    }

    public function commentBlog(Request $request)
    {
        $validatedData = $request->validate([
            'comment' => 'required',
        ], [
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

    public function searchByName(Request $request)
    {
        $products = DB::table('content_post')->select('name')->get()->toArray();
        return response($products);
    }

    public function search(Request $request)
    {
        $data = array();
        $posts = BlogPostModel::where('name', 'like', '%' . $request->name . '%')->get();
        $data['posts'] = $posts;
        $categories = BlogCategoryModel::all();
        $data['categories'] = $categories;
        return view('frontend.content.blog_search', $data);
    }
}

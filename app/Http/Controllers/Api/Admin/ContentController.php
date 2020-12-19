<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategoryModel;
use App\Models\BlogPostModel;
use App\Models\NewsletterModel;
use App\Models\TagModel;
use App\Notifications\NewPostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = BlogPostModel::orderBy('created_at', 'desc')->get();
        $data = array();
        $data['posts'] = $posts;
        return view('admin.blog.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $categories = BlogCategoryModel::all();
        $data['categories'] = $categories;
        $tags = TagModel::where('tag_type', 2)->get();
        $data['tags'] = $tags;
        return view('admin.blog.post.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'unique:content_post',
            'slug' => 'unique:content_post',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
        $post               =   new BlogPostModel();
        $post->name         =   ucwords($input['name']);
        $post->slug         =   $input['slug'];
        $post->image        =   $input['image'];
        $post->intro        =   $input['intro_post'];
        $post->desc         =   $input['desc_post'];
        $post->category_id  =   $input['category_id'];
        //$post->author_id    =   Auth::id();
        $post->author_id    =   1;
        $post->view         =   0;
        $post->save();

        $users = NewsletterModel::all();
        foreach ($users as $user) {
            $user->notify(new NewPostNotification($post));
        }

        foreach ($input['tag'] as $tag) {
            DB::table('taggables')->insertOrIgnore([
                'post_id'       => $post->id,
                'product_id'    => NULL,
                'tag_id'        => $tag,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
        $response = [
            'success'   => true,
            'link'      => url('api/admin/content/posts'),
        ];
        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $data = array();
        $post = BlogPostModel::where('slug', $slug)->first();
        $data['post'] = $post;
        $categories = BlogCategoryModel::all();
        $data['categories'] = $categories;
        $tags = TagModel::where('tag_type', 2)->get();
        $data['tags'] = $tags;

        $sql = DB::select('SELECT 
            A.id
        FROM 
            tags AS A
        JOIN 
            taggables AS B ON A.id = B.tag_id
        JOIN 
            content_post AS C ON C.id = B.post_id
        WHERE
            A.tag_type = 2 
        AND 
            C.id = '.$post->id
        );
        $tagPostIDs = [];
        foreach($sql as $row) {
            array_push($tagPostIDs, $row->id);
        }
        $data['tagPostIDs'] = $tagPostIDs;
        return view('admin.blog.post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $input              =   $request->all();
        $item               =   BlogPostModel::where('slug', $slug)->first();
        $checkNameExist = app(AdminController::class)->checkRecordExist($item->name, $input['name'], 'content_post', 'name');
        $checkSlugExist = app(AdminController::class)->checkRecordExist($item->slug, $input['slug'], 'content_post', 'slug');
        if (!empty($checkNameExist) || !empty($checkSlugExist)) {
            $response = [
                'success'   => false,
                'msg'   => 'Danh mục hoặc slug đã tồn tại',
            ];
            return response()->json($response, 422);
        }
        $item->name         =   ucwords($input['name']);
        $item->slug         =   $input['slug'];
        $item->image        =   $input['image'];
        $item->intro        =   $input['intro_post'];
        $item->desc         =   $input['desc_post'];
        $item->category_id  =   $input['category_id'];
        //$item->author_id    =   Auth::id();
        $item->author_id    =   1;
        $item->view         =   0;
        $item->save();

        $getAllTag = [];
        $getTag = DB::table('taggables')->where('post_id', $item->id)->get();
        foreach ($getTag as $tag) {
            array_push($getAllTag, $tag->tag_id);
        }
        $duplicateTags = array_intersect($getAllTag, $input['tag']);
        $removeTags = array_diff($getAllTag, $duplicateTags);
        $addTags = array_diff($input['tag'], $duplicateTags);
        foreach ($removeTags as $tag) {
            DB::table('taggables')->where('post_id', $item->id)->where('tag_id', $tag)->delete();
        }
        foreach ($addTags as $tag) {
            DB::table('taggables')->insertOrIgnore([
                'post_id'       => $item->id,
                'product_id'    => NULL,
                'tag_id'        => $tag,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
        $response = [
            'success'   => true,
            'link'      => url('api/admin/content/posts'),
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $item = BlogPostModel::where('slug', $slug)->first();
        $item->delete();
        $response = [
            'success'   => true,
            'id'        => $item->id,
        ];
        return response()->json($response, 200);
    }
}

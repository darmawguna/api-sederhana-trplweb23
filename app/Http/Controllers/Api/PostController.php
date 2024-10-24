<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Storage;


class PostController extends Controller
{
    public function index()
    {
        //get all posts
        $posts = Post::latest()->paginate(5);

        //return collection of posts as a resource
        // return new PostResource(true, 'List Data Posts', $posts);
        return response()->json(new PostResource(true, 'Data fetched successfully', $posts));

    }

    public function store(Request $request)
    {
        // define validator rules 
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'contents' => 'required',
        ]);

        // check validator 
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // dd($request->contents);
        $contents = $request->contents;

        // create post 
        $post = Post::create(
            [
                'title' => $request->title,
                'contents' => $contents,
            ]
        );

        return new PostResource(true, 'Data Post Berhasil Ditambahkan!', $post);
    }

    public function show($id)
    {
        //find post by ID
        $post = Post::find($id);

        //return single post as a resource
        return new PostResource(true, 'Detail Data Post!', $post);

    }

    public function update(Request $request, $id)
    {
        // define rules validator 
        $validator = Validator::make($request->all(), [
            'title' => "required",
            'contents' => "required",
        ]);

        // check validator
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = Post::find(($id));
        $post->update([
            'title' => $request->title,
            'contents' => $request->contents,

        ]);

        return new PostResource(true, 'Data Post Berhasil Diubah!', $post);
    }

    public function destroy($id)
    {

        //find post by ID
        $post = Post::find($id);
        //delete post
        $post->delete();

        //return response
        return new PostResource(true, 'Data Post Berhasil Dihapus!', null);
    }
}

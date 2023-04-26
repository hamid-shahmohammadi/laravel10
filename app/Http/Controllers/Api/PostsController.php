<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\postRequestStore;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function all()
    {
        $posts=Post::orderBy('id','DESC')->paginate(5);
        return PostResource::collection($posts);
    }

    public function store(postRequestStore $request)
    {

        Post::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'user_id'=>Auth::id()
        ]);

        $posts=Post::orderBy('id','DESC')->paginate(5);
        return PostResource::collection($posts);

    }
    public function update(postRequestStore $request)
    {
        $post=Post::find($request->id);
        $post->title=$request->title;
        $post->body=$request->body;
        if($post->save()){
            $posts=Post::orderBy('id','DESC')->paginate(5);
            return PostResource::collection($posts);
        }


    }
    public function delete(Post $post)
    {
        if($post->delete()){
            $posts=Post::orderBy('id','DESC')->paginate(5);
            return PostResource::collection($posts);
        }


    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreate;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function all()
    {
        $posts=Post::orderBy('id', 'DESC')->paginate(5);
        return PostResource::collection($posts);
    }

    public function store(PostCreate $request)
    {
        Post::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'user_id'=>Auth::id(),
        ]);

        $posts=Post::orderBy('id', 'DESC')->paginate(5);

        return PostResource::collection($posts);
    }
}

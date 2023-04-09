<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function all()
    {
        $posts=Post::orderBy('id', 'DESC')->paginate(5,['id','title','created_at']);

        return PostResource::collection($posts);
    }
    public function create(Request $request)
    {
        Post::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'user_id'=>Auth::id(),
        ]);

        $posts=Post::orderBy('id', 'DESC')->paginate(5,['id','title','created_at']);

        return PostResource::collection($posts);
    }

}

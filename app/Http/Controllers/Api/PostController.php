<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function all()
    {
        $posts=Post::paginate(5,['id','title','created_at']);

        return PostResource::collection($posts);
    }
}

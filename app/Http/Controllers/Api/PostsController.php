<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostsController extends Controller
{
    public function all()
    {
        $posts=Post::paginate(5);
        return PostResource::collection($posts);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->user()->createToken('post');
        
        return view('post.index', [
            'posts' => Post::paginate(5,['id','title']),
            'token'=>$token->plainTextToken
        ]);
    }
}

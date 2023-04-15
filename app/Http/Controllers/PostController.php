<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $token=$request->user()->createToken('post');
        return view('posts/index',[
            'posts'=>Post::all(),
            'token'=>$token->plainTextToken
        ]);
    }
}

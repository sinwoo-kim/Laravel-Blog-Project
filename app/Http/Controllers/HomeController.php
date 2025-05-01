<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    //
    public function index()
    {
        if (Auth::id()) // 현재 로그인한 사용자의 ID를 반환
        {
            $post = Post::all();
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'user') {
                return view('home.homepage', compact('post'));
            }

            if ($usertype == 'admin') {
                return view('admin.adminhome');
            } else {
                return redirect()->back();
            }
        }
    }

    public function create()
    {
        return view('home.posts.create');
    }

    public function store(Request $request)
    {
        $user = Auth()->user();

        $userid = $user->id;
        $username = $user->name;
        $usertype = $user->usertype;

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $userid;
        $post->name = $username;
        $post->usertype = $usertype;
        $post->post_status = 'pending';

        $image = $request->image;

        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();

            $request->image()->move('postimage', $imagename);

            $post->image = $imagename;
        }

        $post->save();

        return redirect()->route('')->with('success', '');
    }

    public function homepage()
    {
        $post = Post::all();
        return view('home.homepage', compact('post'));
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('home.posts.show', compact('post'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class HomeController extends Controller
{
    //
    public function handleHomeRoute()
    {
        if (Auth::id()) // 현재 로그인한 사용자의 ID를 반환
        {
            $posts = Post::all();
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'user') {
                return view('home.homepage', compact('posts'));
            }

            if ($usertype == 'admin') {
                return view('admin.adminhome');
            } else {
                return redirect()->back();
            }
        }
    }

    public function index()
    {
        $user = Auth::user();
        $userid = $user->id;
        $posts = Post::where('user_id', '=', $userid)->get();

        return view('home.posts.index', compact('posts'));
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

        Alert::info('Success', 'You have Added the post');

        return redirect()->back();
    }

    public function homepage()
    {
        $posts = Post::all();
        return view('home.homepage', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('home.posts.show', compact('post'));
    }

}

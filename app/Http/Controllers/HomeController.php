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

            $request->image->move('postimage', $imagename);

            $post->image = $imagename;
        }

        $post->save();

        Alert::success('success', 'Post Updated Successfully');
        // 명시적으로 인텐디드 URL 지정
        return redirect()->route('posts.index');
    }

    public function homepage()
    {
        $posts = Post::where('post_status', '=', 'active')->get();
        return view('home.homepage', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('home.posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('home.posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->description = $request->description;

        $image = $request->image;

        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('postimage', $imagename);
            $post->image = $imagename;
        }

        $post->save();

        Alert::success('success', 'Post Updated Successfully');
        return redirect()->back();
    }


    public function destroy($id)
    {

        $post = Post::findOrFail($id);
        // 모델이 자동으로 주입됨
        if ($post->image) {
            $imagePath = public_path('postimage/' . $post->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $post->delete();

        Alert::success('success', 'Post Deleted Successfully');
        return redirect()->route('posts.index');
    }
}

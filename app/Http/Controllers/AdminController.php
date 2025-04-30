<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function create()
    {
        return view('admin/posts.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $userId = $user->id;
        $name = $user->name;
        $usertype = $user->usertype;

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->post_status = 'active';
        $post->user_id = $userId;
        $post->name = $name;
        $post->usertype = $usertype;


        $image = $request->image;

        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('postimage', $imagename);
            $post->image = $imagename;
        }

        $post->save();

        return redirect()->back()->with('message', 'Post Added Successfully');
    }

    public function index()
    {
        $post = Post::all();

        return view('admin/posts.show', compact('post'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();
        return redirect()->back()->with('message', 'Post Deleted Successfully');
    }
}

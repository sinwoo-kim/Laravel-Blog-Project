<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    //
    public function index()
    {
        if (Auth::id()) // 현재 로그인한 사용자의 ID를 반환
        {
            $usertype = Auth()->user()->usertype;

            if ($usertype == 'user') {
                return view('dashboard');
            }

            if ($usertype == 'admin') {
                return view('admin.index');
            } else {
                return redirect()->back();
            }
        }
    }

    public function homepage()
    {
        return view('home.homepage');
    }


}

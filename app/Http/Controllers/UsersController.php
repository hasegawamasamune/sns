<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Follow;

class UsersController extends Controller
{
    public function profile(){
        return view('users.profile');
    }

    public function search(){
        // 全てのユーザーをユーザーテーブルから取得する
        $users = User::all();
        // サーチフォルダに表示させる。変数を一つ受け渡し?
        return view('users.search',compact('users'));
    }
    public function follow(User $user)
    {

    }
}

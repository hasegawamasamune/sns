<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follow;

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
    // フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }
    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }
}

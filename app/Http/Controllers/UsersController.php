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

    public function search(User $user){
        // // 全てのユーザーをユーザーテーブルから取得する
        // $users = User::all();
        // // サーチフォルダに表示させる。変数を一つ受け渡し?
        // return view('users.search',compact('users'));
        // ログインユーザー以外を一覧表示
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('users.search', [
            'all_users'  => $all_users
        ]);
    }
    // フォロー
    public function follow($id)
    {
        // authとはログインしているユーザーを取り出すことをしている
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($id);
            return back();
        }
    }
    // フォロー解除
    public function unfollow($id)
    {
        // authとはログインしているユーザーを取り出すことをしている
        $follower = auth()->user();
        // フォローしているか　isFollowingはモデルのメソッドを動かしている
        $is_following = $follower->isFollowing($id);
        if($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($id);
            return back();
        }
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//一対多
use App\Post;
use App\User;
use Auth;
use Validator;

class PostsController extends Controller
{

    //
    public function index()
    {
            $posts = Post::get();
            return view('posts.index',[
                'posts'=> $posts
            ]);
    }

    public function store(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'post' => 'required|max:5',
        ]);

        //バリデーション:エラー
if ($validator->fails()) {
    return redirect('top')
    ->withInput()
    ->withErrors($validator);
}

        //以下に登録処理を記述（Eloquentモデル）
        $posts = new Post;
        $posts->user_id = $request->user_id;
        $posts->post = $request->post;
        $posts->user_id = Auth::id();//ここでログインしているユーザidを登録しています
        $posts->save();

        return redirect('top');
    }

    public function updateForm($id)
    {
        $post = \DB::table('posts')
            ->where('id', $id)
            ->first();
        return view('posts.updateForm', compact('post'));
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        \DB::table('posts')
            ->where('id', $id)
            ->update(
                ['post' => $up_post]
            );

        return redirect('top');
    }
    public function delete($id)
    {
        \DB::table('posts')
        ->where('id',$id)
        ->delete();

        return redirect('top');
    }
}

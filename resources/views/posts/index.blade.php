@extends('layouts.login')

@section('content')
<div class="card-body">
  <!-- バリデーションエラーの表示に使用-->
  @include('posts.errors')
    <!-- 投稿フォーム -->
    @if( Auth::check() )
      <form action="{{ url('posts') }}" method="POST" class="form-horizontal">
      {{ csrf_field() }}
      <!-- 投稿の本文 -->
      <div class="form-group">
      投稿の本文
        <div class="col-sm-6">
          <input type="text" name="post" class="form-control">
        </div>
      </div>
      <!--　登録ボタン -->
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
          <button type="submit" class="btn btn-primary">
            Save
          </button>
        </div>
      </div>
    </form>

</div>
  @endif

 <!-- 全ての投稿リスト -->
  @if (count($posts) > 0)
    <!-- <div class="card-body"> -->
    <div class="card-body">
      <table class="table table-striped task-table">
        <!-- テーブルヘッダ -->
        <thead>
          <th>投稿一覧</th>
          <th> </th>
        </thead>
        <!-- テーブル本体 -->
        <tbody>
          @foreach ($posts as $post)
            <tr>
              <!-- 投稿タイトル -->
              <td class="table-text">
                <div>{{ $post->user->username }}</div>
              </td>
              <!-- 投稿詳細 -->
              <td class="table-text">
                <div>{{ $post->post }}</div>
              </td>
              <!-- 投稿時刻 -->
              <td class="table-text">
                <div>{{ $post->created_at }}</div>
              </td>
              <!-- 更新、削除ボタンの設置 -->
              <td><a class="btn btn-primary" href="/post/{{$post->id}}/update-form">更新</a></td>

           <td><a class="btn btn-danger" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a></td>
           <!-- ボタンここまで -->
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    @endif
    @endsection

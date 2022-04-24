@extends('layouts.login')

@section('content')


        <div class="col-sm-6">
          <input type="text" name="post" class="form-control" placeholder="ユーザー名">
        </div>
        <button type="submit" class="btn btn-primary col-md-5">検索</button>
        @foreach ($users as $user)
            <tr>
              <!-- 投稿タイトル -->
              <td class="table-text">
                <div><img src="{{ asset('images/'.$user->image) }}" alt="プロフィール画像"></div>
              </td>
              <!-- 投稿詳細 -->
              <td class="table-text">
                <div>{{ $user->username }}</div>
              </td>
          </tr>
          @endforeach

@endsection

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
                <!-- コントローラーから引っ張ってきて、カラムの指定をする -->
                <div>{{ $user->username }}</div>
                <!-- フォロー機能ここから -->
                @if (auth()->user()->isFollowing($user->id))
                                    <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-danger">フォロー解除</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                                        {{ csrf_field() }}

                                        <button type="submit" class="btn btn-primary">フォローする</button>
                                    </form>
                                @endif
                <!-- フォロー機能ここまで -->
              </td>
          </tr>
          @endforeach

@endsection

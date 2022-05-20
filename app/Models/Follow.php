<?php
// useで他ファイルから指名するときの名前になる
namespace App\Models;
// 使いたいファイルのネームスペースを指名して使う
use Illuminate\Database\Eloquent\Model;
// 上記のmodelを継承してクラスをつくる
class Follow extends Model
{
    // 要するに、modelを引き継いだfollowクラスを使えばfollowsテーブルの中のホワイトリスト（following_id、followed_id）の二つを使えるようになる。
    // テーブル名
    protected $table = 'follows';

    //ホワイトリスト　値を設定すると保存や更新に必要な記述　データベースの接続に必要な設定
    protected $fillable = [
        'following_id',
        'followed_id'
    ];
}

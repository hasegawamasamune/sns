<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
// Authenticatableを継承してユーザークラスを作った
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password', 'images',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(5);
    }
    public function user() {
        return $this->belongsTo(user::class);
    }
    // postsテーブルとのリレーション（主テーブル側）
    public function posts() { //1対多の「多」側なので複数形
        return $this->hasMany('App\Models\Post');
    }
    // フォローリレーション
    public function followers()
    {
        return $this->belongsToMany(self::class,'follows','followed_id','following_id');
    }
    public function follows()
    {
        return $this->belongsToMany(self::class,'follows','following_id','followed_id');
    }
    // フォローする　下記コピペ
    public function follow(Int $id)
    {
        return $this->follows()->attach($id);
    }

    // フォロー解除する
    public function unfollow(Int $id)
    {
        return $this->follows()->detach($id);
    }

    // フォローしているか
    public function isFollowing($id)
    {
        // booleanはフォローしているかの正誤を判定して返り値としている
        return (boolean) $this->follows()->where('followed_id', $id)->first(['follows.id']);
    }
    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['follows.id']);
    }

}

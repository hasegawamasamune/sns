<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    //
    public function profile(){
        return view('users.profile');
    }

    public function search(){
        $users = User::all();
        return view('users.search',compact('users'));
    }
    // フォロー機能

}

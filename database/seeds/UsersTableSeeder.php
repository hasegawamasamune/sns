<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => '長谷川',
            'mail' => 'abc@icloud.com',
            'password' => 'aaaa',
            'bio' => 'こんにちは。長谷川です。',
        ]);
    }
}

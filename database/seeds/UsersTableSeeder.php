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
            'name' => 'たいよう',
            'email' => 'taiyo-swim@ezweb.ne.jp',
            'password' => Hash::make('Taiyo12345'),
        ]);
    }
}

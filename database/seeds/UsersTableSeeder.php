<?php

use App\Models\User;
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
        User::create([
           'name'               =>  '胖虎',
           'email'              =>  '123456@test.com',
           'password'           =>  bcrypt('12345678'),
           'is_admin'           =>  1,
           'remember_token'     =>  null,
        ]);
    }
}

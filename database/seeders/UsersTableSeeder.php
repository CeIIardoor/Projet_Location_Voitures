<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

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
		'email'=>'yassine.laouina97@gmail.com',
		'password'=>bcrypt('yassinos1997'),
		'firstName'=>'Yassine',
		'lastName'=>'Admin',
		'address'=>'Maroc',
		'phone'=>'03321654',
		'role_id'=>1
	]);
    }
}

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
            'name' => Str::random(10),
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
        ]);
        factory(App\Models\User::class, 50)->create();
    }
}

<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technical_support = new \App\Models\Admin();
        $technical_support->name = 'Admin';
        $technical_support->email = 'admin@gmail.com';
        $technical_support->password = Hash::make('password');
        $technical_support->save();
        $technical_support->assignRole('admin');


    }
}

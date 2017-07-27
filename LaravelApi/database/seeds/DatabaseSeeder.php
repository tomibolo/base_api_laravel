<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //USUARIOS
        DB::table('users')->insert([
            'name' => 'Caca',
            'email' => 'caca@caca.com',
            'password' => bcrypt('caca')
        ]);
    }
}

<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'john',
            'lastname' => 'davis',
            'email' => 'jrj@gmail.com',
            'phone' => '12345678',
            'role'=>'admin',
            'password' => Hash::make('JRJuk8833$$'),
        ]);
    }
}

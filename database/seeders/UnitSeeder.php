<?php
namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            'name' => 'kg',
        ]);
        DB::table('units')->insert([
            'name' => 'Litre',
        ]);
        DB::table('units')->insert([
            'name' => 'Packet',
        ]);
        DB::table('units')->insert([
            'name' => 'Bottle',
        ]);
    }
}

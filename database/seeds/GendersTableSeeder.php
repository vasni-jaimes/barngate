<?php

use Illuminate\Database\Seeder;

class GendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->insert([
            "name" => "All Genders",
        ]);

        DB::table('genders')->insert([
            "name" => "Colt",
        ]);

        DB::table('genders')->insert([
            "name" => "Filly",
        ]);

        DB::table('genders')->insert([
            "name" => "Gelding",
        ]);

        DB::table('genders')->insert([
            "name" => "Mare",
        ]);

        DB::table('genders')->insert([
            "name" => "Stallion",
        ]);
    }
}

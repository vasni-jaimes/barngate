<?php

use Illuminate\Database\Seeder;

class BreedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('breeds')->insert([
            "name" => "All Breeds",
        ]);

        DB::table('breeds')->insert([
            "name" => "Quarter Horse",
        ]);

        DB::table('breeds')->insert([
            "name" => "Paint",
        ]);

        DB::table('breeds')->insert([
            "name" => "Draft",
        ]);

        DB::table('breeds')->insert([
            "name" => "Mule",
        ]);

        DB::table('breeds')->insert([
            "name" => "Thoroughbred",
        ]);

        DB::table('breeds')->insert([
            "name" => "Appaloosa",
        ]);

        DB::table('breeds')->insert([
            "name" => "Mustang",
        ]);

        DB::table('breeds')->insert([
            "name" => "Pony",
        ]);

        DB::table('breeds')->insert([
            "name" => "Other",
        ]);
    }
}

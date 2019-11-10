<?php

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            "name" => "All colors",
        ]);

        DB::table('colors')->insert([
            "name" => "Bay",
        ]);

        DB::table('colors')->insert([
            "name" => "Black",
        ]);

        DB::table('colors')->insert([
            "name" => "Brown",
        ]);

        DB::table('colors')->insert([
            "name" => "Buckskin",
        ]);

        DB::table('colors')->insert([
            "name" => "Chestnut",
        ]);

        DB::table('colors')->insert([
            "name" => "Cremello",
        ]);

        DB::table('colors')->insert([
            "name" => "Dun",
        ]);

        DB::table('colors')->insert([
            "name" => "Gray",
        ]);

        DB::table('colors')->insert([
            "name" => "Grulla",
        ]);

        DB::table('colors')->insert([
            "name" => "Palomino",
        ]);

        DB::table('colors')->insert([
            "name" => "Perlino",
        ]);

        DB::table('colors')->insert([
            "name" => "Roan",
        ]);

        DB::table('colors')->insert([
            "name" => "Sorrel",
        ]);

        DB::table('colors')->insert([
            "name" => "Other",
        ]);
    }
}

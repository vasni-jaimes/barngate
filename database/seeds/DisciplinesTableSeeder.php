<?php

use Illuminate\Database\Seeder;

class DisciplinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('disciplines')->insert([
            "name" => "All colors",
        ]);

        DB::table('disciplines')->insert([
            "name" => "Breeding",
        ]);

        DB::table('disciplines')->insert([
            "name" => "Cutting",
        ]);

        DB::table('disciplines')->insert([
            "name" => "Roping",
        ]);

        DB::table('disciplines')->insert([
            "name" => "Draft",
        ]);

        DB::table('disciplines')->insert([
            "name" => "Mounted Shooting",
        ]);

        DB::table('disciplines')->insert([
            "name" => "Pole Beding",
        ]);

        DB::table('disciplines')->insert([
            "name" => "Racing",
        ]);

        DB::table('disciplines')->insert([
            "name" => "Ranch Horse",
        ]);

        DB::table('disciplines')->insert([
            "name" => "Reining",
        ]);

        DB::table('disciplines')->insert([
            "name" => "Working Cowhorse",
        ]);

        DB::table('disciplines')->insert([
            "name" => "Team Penning",
        ]);

        DB::table('disciplines')->insert([
            "name" => "Trail Riding",
        ]);

        DB::table('disciplines')->insert([
            "name" => "All Around",
        ]);

        DB::table('disciplines')->insert([
            "name" => "Halter",
        ]);

        DB::table('disciplines')->insert([
            "name" => "Western Pleasure",
        ]);


        DB::table('disciplines')->insert([
            "name" => "Driving",
        ]);

         DB::table('disciplines')->insert([
            "name" => "Other",
        ]);
    }
}

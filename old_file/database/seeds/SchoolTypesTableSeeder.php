<?php

use Illuminate\Database\Seeder;

class SchoolTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('school_types')->insert(
            ['type' => 'Primary']
        );
        DB::table('school_types')->insert([
            ['type' => 'High School']
        ]);
        DB::table('school_types')->insert([
            ['type' => 'College']
        ]);
    }
}

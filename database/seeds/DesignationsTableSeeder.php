<?php

use Illuminate\Database\Seeder;

class DesignationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('designations')->insert(
            ['name' => 'Principal']
        );
        DB::table('designations')->insert(
            ['name' => 'Vice-principal']
        );
        DB::table('designations')->insert([
            ['name' => 'Head Teacher']
        ]);
        DB::table('designations')->insert([
            ['name' => 'Assistant Head Teacher']
        ]);
        DB::table('designations')->insert([
            ['name' => 'Assistant Teacher']
        ]);
        DB::table('designations')->insert([
            ['name' => 'Peon']
        ]);
        DB::table('designations')->insert([
            ['name' => 'Nurse']
        ]);
        DB::table('designations')->insert([
            ['name' => 'Trade Instructor']
        ]);
        DB::table('designations')->insert([
            ['name' => 'Office Assistant']
        ]);
        DB::table('designations')->insert([
            ['name' => 'Cook']
        ]);
        DB::table('designations')->insert([
            ['name' => 'Night Guard']
        ]);
        DB::table('designations')->insert([
            ['name' => 'Driver']
        ]);
        DB::table('designations')->insert([
            ['name' => 'Night Watchman']
        ]);
        DB::table('designations')->insert([
            ['name' => 'Watchman']
        ]);
        DB::table('designations')->insert([
            ['name' => 'Other']
        ]);
    }
}

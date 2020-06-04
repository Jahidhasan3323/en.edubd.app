<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert(
            ['name' => 'Root User', 'permission' => 'root']
        );
        DB::table('groups')->insert([
            ['name' => 'School Admin', 'permission' => 'admin']
        ]);
        DB::table('groups')->insert([
            ['name' => 'Teacher', 'permission' => 'teacher']
        ]);
        DB::table('groups')->insert([
            ['name' => 'Student', 'permission' => 'student']
        ]);
        DB::table('groups')->insert([
            ['name' => 'Staff', 'permission' => 'staff']
        ]);
        DB::table('groups')->insert([
            ['name' => 'Commitee', 'permission' => 'commitee']
        ]);
    }
}

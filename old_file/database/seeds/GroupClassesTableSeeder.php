<?php

use Illuminate\Database\Seeder;

class GroupClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_classes')->insert(
            ['name' => 'Genaral']
        );
        DB::table('group_classes')->insert([
            ['name' => 'Science']
        ]);
        DB::table('group_classes')->insert([
            ['name' => 'Humanities']
        ]);

        DB::table('group_classes')->insert([
            ['name' => 'Commerce']
        ]);
    }
}

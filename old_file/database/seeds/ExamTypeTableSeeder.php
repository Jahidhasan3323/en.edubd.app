<?php

use Illuminate\Database\Seeder;

class ExamTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exam_types')->insert(
            ['name' => 'Elective Examination']
        );
        DB::table('exam_types')->insert(
            ['name' => 'First Term Examination']
        );
        DB::table('exam_types')->insert([
            ['name' => 'Mid Term Examination']
        ]);
        DB::table('exam_types')->insert([
            ['name' => 'Annual Examination']
        ]);
    }
}

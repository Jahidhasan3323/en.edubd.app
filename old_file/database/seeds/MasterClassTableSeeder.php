<?php

use Illuminate\Database\Seeder;

class MasterClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_classes')->insert([
            'name' => 'Play',
            'school_type_id'=>1
        ]);
        DB::table('master_classes')->insert([
            'name' => 'Nursery',
            'school_type_id'=>1
        ]);
        DB::table('master_classes')->insert([
            'name' => 'One',
            'school_type_id'=>1
        ]);
        DB::table('master_classes')->insert([
            'name' => 'Two',
            'school_type_id'=>1
        ]);
        DB::table('master_classes')->insert([
            'name' => 'Three',
            'school_type_id'=>1
        ]);
        DB::table('master_classes')->insert([
            'name' => 'Four',
            'school_type_id'=>1
        ]);
        DB::table('master_classes')->insert([
            'name' => 'Five',
            'school_type_id'=>1
        ]);

        DB::table('master_classes')->insert([
            'name' => 'Six',
            'school_type_id'=>2
        ]);
        DB::table('master_classes')->insert([
            'name' => 'Seven',
            'school_type_id'=>2
        ]);
        DB::table('master_classes')->insert([
            'name' => 'Eight',
            'school_type_id'=>2
        ]);
        DB::table('master_classes')->insert([
            'name' => 'Nine',
            'school_type_id'=>2
        ]);
        DB::table('master_classes')->insert([
            'name' => 'Ten',
            'school_type_id'=>2
        ]);

        DB::table('master_classes')->insert([
            'name' => 'Eleven',
            'school_type_id'=>3
        ]);
        DB::table('master_classes')->insert([
            'name' => 'Twelve',
            'school_type_id'=>3
        ]);

        DB::table('master_classes')->insert([
            'name' => 'Degree First Year',
            'school_type_id'=>3
        ]);

        DB::table('master_classes')->insert([
            'name' => 'Degree Second Year',
            'school_type_id'=>3
        ]);

        DB::table('master_classes')->insert([
            'name' => 'Degree Third Year',
            'school_type_id'=>3
        ]);
    }
}

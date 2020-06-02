<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GroupTableSeeder::class);
        $this->call(UserTableSedder::class);
        $this->call(ExamTypeTableSeeder::class);
        $this->call(DesignationsTableSeeder::class);
        $this->call(ServiceTypesTableSeeder::class);
        $this->call(SchoolTypesTableSeeder::class);
        $this->call(GroupClassesTableSeeder::class);
        $this->call(MasterClassTableSeeder::class);
    }
}

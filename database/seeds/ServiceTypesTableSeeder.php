<?php

use Illuminate\Database\Seeder;
use App\ServiceType;

class ServiceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceType::create(['type' => 'ID Card Base','status' => 1]);
        ServiceType::create(['type' => 'Duration Base','status' => 1]);
    }
}

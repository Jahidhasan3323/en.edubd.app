<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'System Root Admin',
            'email' => 'root@user.com',
            'mobile' => '01767248797',
            'password' => bcrypt('123456'),
            'group_id' => 1
        ]);
    }
}

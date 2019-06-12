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
        //$this->call(UsersTableSeeder::class);
        //$this->call(RolTableSeeder::class);
        //$this->call(UserXRolTableSeeder::class);
        //$this->call(SensorTableSeeder::class);
        $this->call(ParDominioSeeder::class);
    }
}

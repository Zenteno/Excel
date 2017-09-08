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
        $this->call(LocationsTableSeeder::class);
        $this->call(CallstatesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ExtensionPhonesTableSeeder::class);
        $this->call(StatesSeeder::class);
        //$this->call(CreateusersTableSeeder::class);
    }
}

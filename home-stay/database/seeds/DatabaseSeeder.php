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
        $this->call(ApartmentsTableSeeder::class);
        $this->call(AdministrationAreaSeeder::class);
    }
}

<?php

use App\HomeStay\Apartment\ApartmentStorageEngine\MySqlEngine;
use App\HomeStay\Apartment\Location;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdministrationAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedCities();
        $this->seedDistricts();
        $this->seedProvinces();
    }

    protected function seedCities()
    {
        \DB::table('cities')->truncate();

        $file = new SplFileObject(__DIR__ . '/administration-data/cities.csv');
        do {
            $field = $file->fgetcsv("\t");

            if ($field)
            {
                \DB::table('cities')->insert([
                    'code'   => $field[0],
                    'name'   => $field[1],
                    'prefix' => $field[2]
                ]);
            }

        } while($field);
    }

    protected function seedDistricts()
    {
        \DB::table('districts')->truncate();

        $file = new SplFileObject(__DIR__ . '/administration-data/districts.csv');
        do {
            $field = $file->fgetcsv("\t");
            
            if ($field)
            {
                \DB::table('districts')->insert([
                    'code'      => $field[0],
                    'name'      => $field[1],
                    'prefix'    => $field[2],
                    'city_code' => $field[4]
                ]);
            }
        } while($field);
    }

    protected function seedProvinces()
    {
        \DB::table('provinces')->truncate();

        $file = new SplFileObject(__DIR__ . '/administration-data/provinces.csv');
        do {
            $field = $file->fgetcsv("\t");

            if ($field)
            {
                \DB::table('provinces')->insert([
                    'code'      => $field[0],
                    'name'      => $field[1],
                    'prefix'    => $field[2],
                    'district_code' => $field[4]
                ]);
            }
        } while($field);
    }
}

<?php

use App\HomeStay\Apartment\ApartmentStorageEngine\MySqlEngine;
use App\HomeStay\Apartment\Location;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $connection = \DB::connection();
        $mysqlEngine = $this->container->make(MySqlEngine::class);
        $connection->table('apartments')->truncate();
        $connection->table('users')->truncate();
        $connection->table('reviews')->truncate();
        $faker = Faker\Factory::create();
        foreach(range(1,15) as $index)
        {
            $connection->table('apartments')->insert([
                [
                    'available_from' => $faker->dateTimeBetween($startDate = '-3 days', $endDate = 'now')->format('Y-m-d H:i:s'),
                    'available_to' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+5 days')->format('Y-m-d H:i:s'),
                    'capacity_from' => $faker->numberBetween($min = 1, $max = 3),
                    'capacity_to' => $faker->numberBetween($min = 3, $max = 10),
                    'location' => with($mysqlEngine->convertLocationToSql(new Location($faker->latitude($min = -90, $max = 90), $faker->longitude($min = -180, $max = 180)))),
                    'city' => $faker->city,
                    'user_id' => $faker->numberBetween($min = 1, $max = 10),
                    'name' => $faker->firstName,
                    'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                    'images' => $faker->imageUrl($width = 640, $height = 480, 'nature'),
                    'price' => $faker->randomFloat($min = 100.00, $max = 500.00),
                    'created_at' => $faker->dateTimeBetween($startDate = '-10 days', $endDate = '-3 days')->format('Y-m-d H:i:s'),
                    'updated_at' => $faker->dateTimeBetween($startDate = '-3 days', $endDate = 'now')->format('Y-m-d H:i:s'),
                ]
            ]);
        }

        foreach (range(1,15) as $item){
            $connection->table('reviews')->insert([
                [
                    'user_id' => $faker->numberBetween($min = 1, $max = 10),
                    'apartment_id' => $faker->numberBetween($min = 1, $max = 15),
                    'rate' => $faker->numberBetween($min = 1, $max = 5),
                    'comment' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
                    'created_at' => $faker->dateTimeBetween($startDate = '-10 days', $endDate = '-3 days')->format('Y-m-d H:i:s'),
                    'updated_at' => $faker->dateTimeBetween($startDate = '-3 days', $endDate = 'now')->format('Y-m-d H:i:s'),
                ],
            ]);
        }

        foreach (range(1,15) as $item){
            $connection->table('users')->insert([
                [
                    'name' => $faker->firstName . $faker->lastName,
                    'email' => $faker->email,
                    'password' => $faker->md5,
                    'created_at' => $faker->dateTimeBetween($startDate = '-10 days', $endDate = '-3 days')->format('Y-m-d H:i:s'),
                    'updated_at' => $faker->dateTimeBetween($startDate = '-3 days', $endDate = 'now')->format('Y-m-d H:i:s'),
                ],
            ]);
        }



    }
}

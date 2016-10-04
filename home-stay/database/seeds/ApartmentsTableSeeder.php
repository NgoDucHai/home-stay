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
        
        $connection->table('apartments')->insert([
            [
                'available_from' => Carbon::today()->subDays(3)->format('Y-m-d H:i:s'),
                'available_to' => Carbon::today()->subDays(2)->format('Y-m-d H:i:s'),
                'capacity_from' => 2,
                'capacity_to' => 6,
                'location' => with($mysqlEngine->convertLocationToSql(new Location(1, 2))),
                'city' => 'Bac Giang',
                'user_id' => 1,
                'name' => 'Ngo hai',
                'description' => 'This is a description',
                'images' => 'urlImage',
                'price' => 100.0
            ]
        ]);


        $connection->table('reviews')->insert([
            ['user_id' => 1, 'apartment_id' => 1, 'rate' => 3, 'comment' => 'say something'],
            ['user_id' => 1, 'apartment_id' => 1, 'rate' => 5, 'comment' => 'say something1'],
            ['user_id' => 2, 'apartment_id' => 2, 'rate' => 5, 'comment' => 'say something3'],
        ]);

        $connection->table('users')->insert([
            ['name' => 'Hai Ngo', 'email' => 'haingo6394@gmail.com', 'password' => '12345'],
            ['name' => 'Hai Ngo1', 'email' => 'haingo63941@gmail.com', 'password' => '12345'],
            ['name' => 'Hai Ngo2', 'email' => 'haingo63942@gmail.com', 'password' => '12345'],
        ]);
    }
}

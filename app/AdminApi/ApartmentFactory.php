<?php
namespace App\AdminApi;


use DateTime;
use Carbon\Carbon;

class ApartmentFactory
{
    public function factoryRequest($rawApartment)
    {


        $start_date = new DateTime();
        $start_date->setTimestamp(strtotime($rawApartment['available_from']));
        $end_date = new DateTime();
        $end_date->setTimestamp(strtotime($rawApartment['available_to']));

        return [
            'available_from' => Carbon::createFromFormat('Y-m-d H:i:s', $start_date->format('Y-m-d H:i:s')),
            'available_to' => Carbon::createFromFormat('Y-m-d H:i:s', $end_date->format('Y-m-d H:i:s')),
            'capacity_from' => intval($rawApartment['capacity_from']),
            'capacity_to'   => intval($rawApartment['capacity_to']),
            'name' => $rawApartment['name'],
            'description' => $rawApartment['description'],
            'city' => $rawApartment['city'],
            'district' => $rawApartment['district'],
            'province' => $rawApartment['province'],
            'price'   => $rawApartment['price']
        ];

    }
}
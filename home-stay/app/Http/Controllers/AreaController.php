<?php

namespace App\Http\Controllers;

use DB;

class AreaController extends Controller
{
    public function getCity()
    {
        $cities = DB::table("cities")->get();
        return json_encode($cities);
    }


    public function getDistrict($id)
    {
        $districts = DB::table("districts")
            ->where("city_code",$id)
            ->get();

        return json_encode($districts);
    }

    public function getProvince($id)
    {
        $provinces = DB::table("provinces")
            ->where("district_code",$id)
            ->get();

        return json_encode($provinces);
    }

}
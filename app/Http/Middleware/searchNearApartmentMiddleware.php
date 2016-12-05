<?php

namespace App\Http\Middleware;

use App\HomeStay\Apartment\ApartmentNearbySearchCondition;
use App\HomeStay\Apartment\Location;
use Carbon\Carbon;
use Closure;
use DateTime;
use Illuminate\Http\Request;
use Validator;

class searchNearApartmentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        /** @var Validator $validator */
        $validator = $this->makeValidator($request);
        if ($validator->fails()){
            return response()->json([
                'status' => 'error',
                'code'   => 'DATA_IS_INVALID',
                'message' => $validator->errors()->all()
            ]);
        }

        $condition = $this->makeCondition($request);
        app()->bind(get_class($condition), function () use ($condition) {
            return $condition;
        });
        return $next($request);
    }

    public function makeCondition(Request $request)
    {
        $params = $request->all();
        $lat = $params['lat'];
        $lng = $params['lng'];
        $location = new Location($lat, $lng);
        $radius = $params['radius'];
        $condition = new ApartmentNearbySearchCondition($location, $radius);
        $start_date = new DateTime();
        $start_date->setTimestamp(strtotime($params['available_from']));
        $end_date = new DateTime();
        $end_date->setTimestamp(strtotime($params['available_to']));
        $condition->availableIn($start_date, $end_date)
                  ->hasCapacity($params['capacity']);
        return $condition;
    }

    public function makeValidator(Request $request)
    {
        $today = Carbon::now()->format('d-m-Y');
        $rule = [
            'available_from'    => 'required|date_format:d-m-Y|after:'. $today,
            'available_to'      => 'required|date_format:d-m-Y|after:available_from',
            'capacity'          => 'required|min:1',
        ];
        return Validator::make($request->all(), $rule, $this->message());

    }


    public function message()
    {
        return [
            'available_from.required'   => 'Ngay bat dau',
            'available_to.required'     => 'Nhap ngay ket thuc',
            'capacity.required'         => 'Chon so luong nguoi nho nhat',
        ];
    }
}

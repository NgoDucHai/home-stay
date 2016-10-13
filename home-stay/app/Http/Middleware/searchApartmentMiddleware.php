<?php

namespace App\Http\Middleware;

use App\HomeStay\Apartment\ApartmentAreaSearchCondition;
use App\HomeStay\Apartment\Area;
use Carbon\Carbon;
use Closure;
use DateTime;
use Illuminate\Http\Request;
use Validator;

class searchApartmentMiddleware
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
        $condition = new ApartmentAreaSearchCondition();
        $params = $request->all();
        $area = new Area($params['city']);
        $start_date = new DateTime();
        $start_date->setTimestamp(strtotime($params['available_from']));
        $end_date = new DateTime();
        $end_date->setTimestamp(strtotime($params['available_to']));
        if ($params['district']) $area->setDistrict($params['district']);
        if ($params['province']) $area->setProvince($params['province']);
        $condition->availableIn($start_date, $end_date)
                  ->hasCapacity($params['capacity'])
                  ->in($area);
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

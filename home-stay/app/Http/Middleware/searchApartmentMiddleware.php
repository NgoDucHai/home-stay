<?php

namespace App\Http\Middleware;

use App\HomeStay\Apartment\ApartmentAreaSearchCondition;
use App\HomeStay\Apartment\Area;
use Closure;
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
        if ($params['district']) $area->setDistrict($params['district']);
        if ($params['province']) $area->setProvince($params['province']);
        $condition->availableIn(new \DateTime($params['available_from']), new \DateTime($params['available_to']))
                  ->hasCapacityFrom($params['capacity_from'], $params['capacity_to'])
                  ->in($area);
        return $condition;
    }

    public function makeValidator(Request $request)
    {
        $rule = [
            'available_from'    => 'required|date',
            'available_to'      => 'required|date|after:available_from',
            'capacity_from'     => 'required|min:1',
            'capacity_to'       => 'required|min:capacity_from',
        ];
        return Validator::make($request->all(), $rule, $this->message());

    }


    public function message()
    {
        return [
            'available_from.required'   => 'Ngay bat dau',
            'available_to.required'     => 'Nhap ngay ket thuc',
            'capacity_from.required'    => 'Chon so luong nguoi nho nhat',
            'capacity_to.required'      => 'Chon so luong nguoi lon nhat',
            'capacity_to.min'           => 'So luong lon nhat phai lon hon so luong be nhat',
        ];
    }
}

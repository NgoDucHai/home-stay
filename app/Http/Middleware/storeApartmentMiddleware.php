<?php

namespace App\Http\Middleware;

use App\HomeStay\Apartment\ApartmentFactory;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class storeApartmentMiddleware
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

        $apartment = $this->makeApartment($request);
        app()->bind(get_class($apartment), function () use ($apartment) {
            return $apartment;
        });
        return $next($request);
    }

    public function makeApartment(Request $request)
    {
        $apartmentFactory = new ApartmentFactory();
        return $apartmentFactory->factoryRequest($request->all());

    }

    public function makeValidator(Request $request)
    {
        $today = Carbon::now()->format('d-m-Y');
        $rule = [
            'name'              => 'required|unique:apartments|max:255',
            'description'       => 'required',
            'available_from'    => 'required|date_format:d-m-Y|after:'. $today,
            'available_to'      => 'required|date_format:d-m-Y|after:available_from',
            'capacity_from'     => 'required|min:1',
            'capacity_to'       => 'required|min:capacity_from',
            'price'             => 'required'
        ];
        return Validator::make($request->all(), $rule, $this->message());

    }


    public function message()
    {
        return [
            'name.required'             => 'Hay nhap ten homestay',
            'name.unique'               => 'Ten da ton tai',
            'description'               => 'Nhap mo ta',
            'available_from.required'   => 'Ngay bat dau',
            'available_to.required'     => 'Nhap ngay ket thuc',
            'capacity_from.required'    => 'Chon so luong nguoi nho nhat',
            'capacity_to.required'      => 'Chon so luong nguoi lon nhat',
            'capacity_to.min'           => 'So luong lon nhat phai lon hon so luong be nhat',
            'price.required'            => 'Nhap gia'
        ];
    }
}

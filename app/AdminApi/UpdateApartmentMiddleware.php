<?php

namespace App\AdminApi;

use Illuminate\Http\Request;
use Validator;

/**
 * Class AdminOnlyMiddleware
 * @package App\AdminApi
 */
class UpdateApartmentMiddleware
{

    /**
     * UpdateApartmentMiddleware constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     * @throws AdminOnlyException
     */
    public function handle(Request $request, \Closure $next)
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


        return $next($request);
    }


    public function makeValidator(Request $request)
    {
        $rule = [
            'name'              => 'required|max:255',
            'description'       => 'required',
            'available_from'    => 'required',
            'available_to'      => 'required|after:available_from',
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

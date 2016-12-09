<?php

namespace App\AdminApi\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{

    protected static $locationMetadata = [];

    protected $table = 'apartments';

    protected $fillable = ['available_from', 'available_to', 'capacity_from', 'capacity_to', 'images', 'price', 'name', 'city', 'district', 'province'];

    protected function getAvailableFromAttribute($value)
    {
        return new Carbon($value);
    }

    protected function getAvailableToAttribute($value)
    {
        return new Carbon($value);
    }

    protected static function boot()
    {
        parent::boot();

        self::$locationMetadata = [
            'cities' => \DB::connection()->table('cities')->get(),
            'districts' => \DB::connection()->table('districts')->get(),
            'provinces' => \DB::connection()->table('provinces')->get()
        ];

        static::addGlobalScope('location', function (Builder $builder)
        {
            return $builder->select('*')->selectRaw('X(location) as `lat`')->selectRaw('Y(location) as `long`');
        });
    }

    protected function getImagesAttribute($images)
    {
        return json_decode($images) ?: [];
    }

    protected function getCityAttribute($cityId)
    {
        return array_first(static::$locationMetadata['cities'], function ($index, $city) use ($cityId)
        {
            return $city->id == intval($cityId);
        });
    }

    protected function getDistrictAttribute($districtId)
    {
        return array_first(static::$locationMetadata['districts'], function ($index, $district) use ($districtId)
        {
            return $district->code == intval($districtId);
        });
    }

    protected function getProvinceAttribute($provinceId)
    {
        return array_first(static::$locationMetadata['provinces'], function ($index, $province) use ($provinceId)
        {
            return $province->code == intval($provinceId);
        });
    }


    protected function getFormattedAddress()
    {
        $city = $this->getAttribute('city');
        $district = $this->getAttribute('district');
        $province = $this->getAttribute('province');
        $formattedAddress = [];

        if ($province) {
            array_push($formattedAddress, "$province->prefix $province->name");
        }

        if ($district) {
            array_push($formattedAddress, "$district->prefix $district->name");
        }

        if ($city) {
            array_push($formattedAddress, "$city->prefix $city->name");
        }

        return implode($formattedAddress, ', ');
    }

    /**
     * @param int $options
     * @return string
     */
    public function toArray($options = 0)
    {
        return [
            'id'    => $this->getAttribute('id'),
            'name'  => $this->getAttribute('name'),
            'timestamps' => [
                'created_at' => $this->getAttribute('created_at')->getTimestamp(),
                'updated_at' => $this->getAttribute('created_at')->getTimestamp()
            ],
            'available' => [
                'from' => $this->getAttribute('available_from')->getTimestamp(),
                'to' => $this->getAttribute('available_to')->getTimestamp(),
            ],
            'capacity' => [
                'from' => $this->getAttribute('capacity_from'),
                'to' => $this->getAttribute('capacity_to'),
            ],
            'location' => [
                'lat' => $this->getAttribute('lat'),
                'long' => $this->getAttribute('long')
            ],
            'address' => [
                'city' =>  $this->getAttribute('city'),
                'district' => $this->getAttribute('district'),
                'province' => $this->getAttribute('province'),
                'formatted_address' => $this->getFormattedAddress()
            ],
            'user_id' => $this->getAttribute('user_id'),
            'description' => $this->getAttribute('description'),
            'price' => $this->getAttribute('price'),
            'images' => $this->getAttribute('images')
        ];
    }
}
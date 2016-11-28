<?php

namespace App\EarthGeometry;

class Earth
{
    const R = 6371;

    /**
     * @param $lat
     * @param $lng
     * @param int $distance
     * @return array
     */
    public static function boundary($lat, $lng, $distance = 100)
    {
        $maxLat = $lat + rad2deg( $distance / self::R );
        $minLat = $lat - rad2deg( $distance / self::R );

        $maxLng = $lng + rad2deg( $distance / self::R) / cos( deg2rad( ( float ) $lat ) );
        $minLng = $lng - rad2deg( $distance / self::R) / cos( deg2rad( ( float ) $lat ) );

        return [
            'maxLat' => $maxLat,
            'minLat' => $minLat,
            'maxLng' => $maxLng,
            'minLng' => $minLng
        ];
    }

    /**
     * @param $latitudeFrom
     * @param $longitudeFrom
     * @param $latitudeTo
     * @param $longitudeTo
     * @return int
     */
    public static function haversineDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $latFrom = deg2rad($latitudeFrom);
        $lngFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lngTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lngDelta = $lngTo - $lngFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lngDelta / 2), 2)));
        return $angle * self::R;
    }
}

<?php

namespace App\HomeStay;

interface GeometryDataType
{
    public function toSql();

    public static function toSelectFields($geoFieldName);
}
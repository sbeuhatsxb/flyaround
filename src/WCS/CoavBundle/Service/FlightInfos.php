<?php

namespace WCS\CoavBundle\Service;

use WCS\CoavBundle\Entity\PlaneModel;


class FlightInfos{

    /**
    * @var string
    */
    private $unit;

    public function __construct($unit){
        $this->unit = $unit;
    }


    /**
    *
    *  Calcule de distance entre deux points géographiques
    *
    * @param $latitudeFrom
    * @param $longitudeFrom
    * @param $latitudeTo
    * @param $longitudeTo
    */
    public function getDistances($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo)
    {
        $d = 0;
        $earth_radius = 6371;
        $dLat = deg2rad($latitudeTo - $latitudeFrom);
        $dLon = deg2rad($longitudeTo - $longitudeFrom);

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));

        switch ($this->unit){
            case 'km':
                $d = $c * $earth_radius;
                break;
            case 'mi':
                $d = $c * $earth_radius / 1.609344;
                break;
            case 'nmi':
                $d = $c * $earth_radius / 1.852;
                break;
        }

        return $d;
    }

    
    public function getHour($d, $flight_speed)
    {
        $flight_travel_dec = ($d  / $flight_speed);
        $hour = floor($flight_travel_dec);
        return $hour;
    }

    public function getMinute($d, $flight_speed)
    {
        $flight_travel_dec = ($d  / $flight_speed);
        $minute = ($flight_travel_dec - floor($flight_travel_dec)) * 60;
        return $minute;
    }


}

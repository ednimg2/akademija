<?php

namespace Nfq\WeatherBundle\Parser;

class OpenWeatherMapParser
{

    /**
     * @param $json
     * @return mixed
     */
    public function getTemperature($json)
    {
        $res = json_decode($json, true);
        return $res['main']['temp'];
    }
}
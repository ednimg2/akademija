<?php

namespace Nfq\WeatherBundle\Parser;

class YahooWeatherParser
{

    /**
     * @param $json
     * @return mixed
     */
    public function getTemperature($json)
    {
        $res = json_decode($json, true);
        return  $res['query']['results']['channel']['item']['condition']['temp'];
    }
}
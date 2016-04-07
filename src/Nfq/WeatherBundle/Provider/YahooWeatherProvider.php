<?php

namespace Nfq\WeatherBundle\Provider;

use Nfq\WeatherBundle\Classes\Weather;
use Nfq\WeatherBundle\Classes\Location;

class YahooWeatherProvider implements WeatherProviderInterface
{

    /**
     * @param Location $location
     * @return Weather
     */
    public function fetch(Location $location):Weather
    {
        $base_url = "https://query.yahooapis.com/v1/public/yql";
        $yql_query = "select * from weather.forecast where woeid in (select woeid from geo.places(1) where text='". $location->location ."')  and u='c'";
        $yql_query_url = $base_url . "?q=" . urlencode($yql_query) . "&format=json";
        $json = file_get_contents($yql_query_url);
        $res = json_decode($json, true);
        $temperature = $res['query']['results']['channel']['item']['condition'];

        $weather = new Weather($temperature);

        return $weather;
    }
}


?>
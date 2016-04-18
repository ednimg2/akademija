<?php

namespace Nfq\WeatherBundle\Provider;

use Nfq\WeatherBundle\Classes\Weather;
use Nfq\WeatherBundle\Classes\Location;
use Nfq\WeatherBundle\Parser\YahooWeatherParser;

class YahooWeatherProvider implements WeatherProviderInterface
{

    public function __construct(YahooWeatherParser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * @param Location $location
     * @return Weather
     */
    public function fetch(Location $location):Weather
    {
        $weather = new Weather();
        $city = $location->getLocation();
        $base_url = "https://query.yahooapis.com/v1/public/yql";
        $yql_query = "select * from weather.forecast where woeid in (select woeid from geo.places(1) where text='". $city ."')  and u='c'";
        $yql_query_url = $base_url . "?q=" . urlencode($yql_query) . "&format=json";
        $json = file_get_contents($yql_query_url);

        $temperature = $this->parser->getTemperature($json);
        $weather->setTemperature($temperature);
        $weather->setProvider("Yahoo");

        return $weather;
    }
}


?>
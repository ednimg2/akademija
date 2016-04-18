<?php

namespace Nfq\WeatherBundle\Provider;

use Nfq\WeatherBundle\Classes\Weather;
use Nfq\WeatherBundle\Classes\Location;
use Nfq\WeatherBundle\Parser\OpenWeatherMapParser;

class OpenWeatherMapProvider implements WeatherProviderInterface
{
    public function __construct(OpenWeatherMapParser $parser, string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->parser = $parser;
    }

    /**
     * @param Location $location
     * @return Weather
     */
    public function fetch(Location $location): Weather
    {
        $weather = new Weather();
        $city = $location->getLocation();
        $apiKey = $this->apiKey;
        $json = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q='.$city.',lt&units=metric&appid='.$apiKey);
        $temperature = $this->parser->getTemperature($json);
        $weather->setTemperature($temperature);
        $weather->setProvider("OpenWeatherMap");

        return $weather;
    }
}
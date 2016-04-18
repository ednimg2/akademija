<?php

namespace Nfq\WeatherBundle\Provider;

use Nfq\WeatherBundle\Classes\Location;
use Nfq\WeatherBundle\Classes\Weather;
use Nfq\WeatherBundle\Parser\YahooParser;
use Nfq\WeatherBundle\Parser\OpenWeatherMapParser;
use Nfq\WeatherBundle\Parser\YahooWeatherParser;

class DelegatingProvider implements WeatherProviderInterface
{
    private $providers;
    private $apiKey;

    public function __construct($providers, $apiKey)
    {
        $this->providers = $providers;
        $this->apiKey = $apiKey;
    }

    /**
     * @param Location $location
     * @return Weather
     */
    public function fetch(Location $location): Weather
    {
        foreach ($this->providers as $provider) {
            switch ($provider) {
                case 'Nfq\WeatherBundle\Provider\YahooWeatherProvider':
                    $provider = new $provider(new YahooWeatherParser());
                    break;
                case 'Nfq\WeatherBundle\Provider\OpenWeatherMapProvider':
                    $provider = new $provider(new OpenWeatherMapParser(), $this->apiKey['OpenWeatherMap']);
                    break;
            }
            $weather = $provider->fetch($location);
            return $weather;
        }
    }
}
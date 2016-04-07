<?php

namespace Nfq\WeatherBundle\Provider;

use Nfq\WeatherBundle\Classes\Weather;
use Nfq\WeatherBundle\Classes\Location;

interface WeatherProviderInterface
{
    /**
     * @param Location $location
     * @return Weather
     */
    public function fetch(Location $location):Weather;
}
<?php

namespace Nfq\WeatherBundle\Classes;

class Location
{
    /**
     * Location constructor.
     * @param $location
     */
    public function __construct($location)
    {
        $this->location = $location;
    }
}
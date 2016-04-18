<?php

namespace Nfq\WeatherBundle\Classes;

class Location
{
    private $location;

    /**
     * Location constructor.
     * @param $location
     */
    public function __construct($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }
}
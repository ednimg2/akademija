<?php

namespace Nfq\WeatherBundle\Classes;

class Weather
{
    public $temperature;

    /**
     * Weather constructor.
     * @param $temperature
     */
    public function __construct($temperature)
    {
        $this->temperature = $temperature;
    }

}
<?php

namespace Nfq\WeatherBundle\Classes;

class Weather
{
    private $temperature;

    private $provider;

    /**
     * @return mixed
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @param $temperature
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

}
<?php

namespace Nfq\WeatherBundle\Controller;

use Nfq\WeatherBundle\Classes\Location;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class DefaultController extends Controller
{

    /**
     * @Route("weather/yahoo/{location}")
     * @Route("/weather")
     */
    public function yahooAction($location)
    {
        $location = new Location($location);
        $provider = $this->get('nfq_weather.provider.yahooweather');

        $weather = $provider->fetch($location);

        $params = [
            'temp'      => $weather->getTemperature(),
            'provider'  => $weather->getProvider(),
        ];
        return $this->render('NfqWeatherBundle:Default:index.html.twig', $params);
    }

    /**
     * @Route("weather/openweathermap/{location}")
     * @Route("/weather")
     */
    public function openweathermapAction($location)
    {
        $location = new Location($location);
        $provider = $this->get('nfq_weather.provider.openweathermap');

        $weather = $provider->fetch($location);

        $params = [
            'temp'      => $weather->getTemperature(),
            'provider'  => $weather->getProvider(),
        ];
        return $this->render('NfqWeatherBundle:Default:index.html.twig', $params);
    }

}

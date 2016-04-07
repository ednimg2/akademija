<?php

namespace Nfq\WeatherBundle\Controller;

use Nfq\WeatherBundle\Classes\Location;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
class DefaultController extends Controller
{
    /**
     * @Route("weather/{location}")
     * @Route("/weather")
     */
    public function indexAction($location)
    {
        $location = new Location($location);
        $provider = $this->get('nfq_weather');
        $weather = $provider->fetch($location);
        //print_r( $weather->temperature );
        $params = [
            'temp' => $weather->temperature['temp'],
        ];
        return $this->render('NfqWeatherBundle:Default:index.html.twig', $params);
    }
    /*
    /**
     * @Route("/weather/{city}")
     * @Route("/weather")
     *
    public function indexAction($city = "")
    {
        if($city != '') {
            $client = new Client();
            $base_url = "https://query.yahooapis.com/v1/public/yql";
            $yql_query = "select * from weather.forecast where woeid in (select woeid from geo.places(1) where text='" . $city . "')  and u='c'";
            $yql_query_url = $base_url . "?q=" . urlencode($yql_query) . "&format=json";

            echo $yql_query_url;

            $res = $client->request('GET', $yql_query_url);

            $body = json_decode($res->getBody(true));
            //echo"<pre>";print_r( $body->query->results->channel );echo"</pre>";
            $item = $body->query->results->channel;
            $params = [
                'title' => $item->title,
                'temp' => $item->item->condition->temp,
                'units' => $item->units
            ];
            return $this->render('NfqWeatherBundle:Default:index.html.twig', $params);
        } else {
            $params = [
                'title' => ''
            ];
            return $this->render('NfqWeatherBundle:Default:index.html.twig', $params);
        }
    }*/
}

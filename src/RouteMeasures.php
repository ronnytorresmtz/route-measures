<?php

namespace Ronnytorresmtz\RouteMeasures;

use Laravel\Nova\Fields\Field;
use Illuminate\Support\Facades\Log;

class RouteMeasures extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'route-measures';

    /**
     * Indicates if the element should be shown on the edit pages.
     *
     * @var bool
     */
    public $showOnCreation = false;
    public $showOnUpdate = false;

    /**
     * Get Measures distance and duration of a route calling MapBox Direction API 
     *
     * @param from pair of Geo Coordinates (longitude, latitude)
     * @param to pair of Geo Coordinates (longitude, latitude)
     * @param token access token for MapBox Direction APU
     * 
     * @return Array
     */ 
    public function route($from, $to, $token) {

            $route = $from . ';' . $to;

            $response = $this->callToMapboxApi($route, $token);

            $measures = $this->getMeasures($response);
            
            return $this->withMeta([

                'distance' =>  [
                    'kms' =>  $measures['kms'],
                    'miles' => $measures['miles'],
                ],

                'duration' => [ 
                    'hours' => $measures['hours'], 
                    'minutes' => $measures['minutes'], 
                ],

                'response' => [
                    'code' => $measures['code'],
                    'message' => $measures['message'],
                ],
            ]);
        
    }

    /**
     * Consume MapBox Direction API 
     *
     * @return Array
     */
    public function callToMapboxApi($route, $token) {

        $ch = curl_init();
        //build url
        $url = $this->buildUrl($route, $token);
        // set url
        curl_setopt($ch, CURLOPT_URL, $url);
        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // set timeout
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        // $output contains the output string
        $response['data'] = json_decode(curl_exec($ch));
        // get http code
        $response['code'] = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        // close curl resource to free up system resources
        curl_close($ch);   

        return $response;

    }

    /**
     * Get the distance and duration of the route, 
     * Route is a set of pairs of longitude and latitude
     *
     * @return Array
     */
    public function getMeasures($response) {

        $measures = [];

        if ($response['code'] != 200) {

            $measures['kms'] = '';
            $measures['miles'] = '';
            $measures['hours'] = '';
            $measures['minutes'] = '';
            $measures['message'] = __('Measure field calculation failed! ( API Error Code: ' . $response['code'] .' )');

        } else {
            $distance = $response['data']->routes[0]->distance;
            $duration = $response['data']->routes[0]->distance;
        
            $measures['kms'] = round($distance / 1000);
            $measures['miles'] = round($distance / 1609.34);
            $measures['hours'] = floor($duration / 3600);
            $measures['minutes'] = round(($duration / 60) % 60);
            $measures['message'] = 'OK';
            
        }
        
        $measures['code'] = $response['code'];

        return $measures;

    }

    /**
     * Build a URL to Call MapBox Direction API with the mode/profile of driving
     * Route is a set of pairs of longitude and latitude
     *
     * @return string
     */
    public function buildUrl($route, $token) {

        $api_url = 'https://api.mapbox.com/';
        $api_service = 'directions/v5/';
        $api_mode = 'mapbox/driving/';
        $wayPoints = $route;
        $url_params = ['access_token' => $token];

        $url = $api_url . $api_service . $api_mode . $wayPoints . '?' .http_build_query($url_params);

        return $url;

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WeatherApi\WeatherApi;

/**
 * Controller for weather api endpoints
 */
class WeatherController extends Controller
{
    public function getCity($city){
        $wApi = new WeatherApi();
        return $wApi->requestCity($city);
    }

}

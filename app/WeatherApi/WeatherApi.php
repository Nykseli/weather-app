<?php

namespace App\WeatherApi;

use App\WeatherApi\WeatherApiExcpetion;

class WeatherApi
{

    static private $baseUrl = "https://api.openweathermap.org";
    static private $baseUri = "/data/2.5/weather?units=metric";
    static private $keyParam;
    static private $requestUrl;

    public function __construct()
    {
        if (env("WEATHER_API_KEY", null) != null) {
            WeatherApi::$requestUrl .= WeatherApi::$baseUrl;
            WeatherApi::$requestUrl .= WeatherApi::$baseUri;
            WeatherApi::$requestUrl .= "&APPID=" . env("WEATHER_API_KEY");
            WeatherApi::$keyParam = "&APPID=" . env("WEATHER_API_KEY");
        } else {
            throw new WeatherApiExcpetion("Weather Api key is not defined. Check .env");
        }
    }

    public function requestCity(string $cityName)
    {
        $uri = WeatherApi::$baseUri . WeatherApi::$keyParam . "&q=" . $cityName;
        $client = new \GuzzleHttp\Client(['base_uri' => WeatherAPI::$baseUrl]);
        $response = $client->request('GET', $uri);
        //var_dump($response->getBody());
        //TODO: validate responce and return http 500 if it fails
        $respJson = \json_decode($response->getBody(), true);
        $returnJson = array();
        $returnJson['cityName'] = $respJson['name'];
        $returnJson['temperature'] = $respJson['main']['temp'];
        return $returnJson;
    }
}

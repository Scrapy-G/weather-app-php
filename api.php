<?php 
$weatherKey = "openweather api key";

function fetchWeather($city) {
    global $weatherKey;
    $request = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$weatherKey&units=metric";
    $response = file_get_contents($request);
    $result = json_decode($response);
    
    if($result->cod == "200")
        return $result;

    return "NO_RESULT";

}



<?php 
$weatherKey = "c30407bfed95af238f9d09c1922f692a";

function fetchWeather($city) {
    global $weatherKey;
    $request = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$weatherKey&units=metric";
    $response = file_get_contents($request);
    $result = json_decode($response);
    
    if($result->cod == "200")
        return $result;

    return "NO_RESULT";

}



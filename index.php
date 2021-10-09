<?php
require_once "api.php";

$city = $weather = "";

if(isset($_GET["city"])){
    $city = $_GET["city"];
    $weather = fetchWeather(urlencode($city));
}

echo "<html>
    <head><title>Weather</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta charset='UTF-8'>
    <link rel='stylesheet' href='style.css' />
    </head>
    <body>
    <div class='app'>
    <form method='get'>
        <input name='city' type='text' placeholder='city'/>
        <button type='submit'>
            <img src='https://img.icons8.com/fluency-systems-regular/24/FFF/search--v2.png' alt='search'/>
        </button>
    </form>
    <div class='weather'>";

if($weather != "NO_RESULT"){
    $icon = $weather->weather[0]->icon;
    $temp = (int) $weather->main->temp;
    $description = $weather->weather[0]->description;
    $sunrise = convertDate($weather->sys->sunrise, "UTC", "EST");
    $sunset = convertDate($weather->sys->sunset, "UTC", "EST");

    $country = $weather->sys->country;
    
    echo "<p class='city'>$city, $country</p>
        <img src='http://openweathermap.org/img/wn/$icon@4x.png' alt='weather'/>    
        <h1>$temp&#176;C</h1>
        <p>$description</p>  
        <div class='details'>
            <div class='box'><img src='https://img.icons8.com/ios-glyphs/30/cfcfcf/sunrise.png' alt='sunrise'/>
            <p>" . $sunrise->format('H:i') . "</p></div>
            <div class='box'><img src='https://img.icons8.com/ios-glyphs/30/cfcfcf/sunset.png' alt='sunset'/>
            <p>" . $sunset->format('H:i') . "</p></div>
        </div>";  
           
}else
    echo "<h3>No result</h2>";

echo "</div></div></body>";

//converts a timestamp to desired timezone
function convertDate($timestamp, $fromZone, $toZone){
    $datetime = new DateTime("@$timestamp", new DateTimeZone($fromZone));
    $datetime->setTimeZone(new DateTimeZone($toZone));
    return $datetime;
}
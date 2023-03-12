<?php
function Egypt_City($var){
    return($var['country']=="EG");
}
use GuzzleHttp\Client;
require_once("./vendor/autoload.php");
ini_set('memory_limit', '-1');
$citiesList = file_get_contents("./city.list.json");
$json_cities = json_decode($citiesList, true);  //decode the file
$egyptCities = array_filter($json_cities,"Egypt_City"); //to get array of egypt countries

if(!empty($_POST)){
    if(isset($_POST["submit"])){
        $city_id = $_POST["city"];
        $apiUrl = "https://api.openweathermap.org/data/2.5/weather?id=" . $city_id . "&appid=" . "8bb709db69b1b8aaf1bb6d4445f5b0c4";
        $client = new Client();
        $response = $client  ->  get($apiUrl);
        //$egyptian_cities = $weather->get_cities();
        $data = json_decode($response->getBody(), true);
        $current_time = date("F g:i a");
        $current_time2 = date(" jS \ F , Y ");

        $icon = "https://openweathermap.org/img/wn/". $data["weather"][0]["icon"] . "@2x.png";        
        if(!empty($data)){
            die('<body>
            <div style=
                width:50%;
                margin:8vh auto;
                padding:3%;
                border-radius: 20px;">'
                . '<center><h2 style="color:#30534c;">' . $data["name"] . ' Weather Status</h2></br>'
                . "<p> " . $current_time . "</p>"
                . "<p> " . $current_time2 . "</p>"
                . "<p> " . $data["weather"][0]["description"] . "</p>"
                . '<img src="' . $icon . '" alt="">'
                ."<p> Humidity:  ".$data["main"]["humidity"]."%</p>"
                ."<p> Wind:  ".($data["wind"]["speed"])." Km/h</p>"
                . '</center>' .
                '</div> </body>');
        }
    }
}
require_once("./weather.php");

?>
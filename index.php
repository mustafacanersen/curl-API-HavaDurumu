<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.collectapi.com/weather/getWeather?data.lang=tr&data.city=ankara",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "authorization: apikey 5aF3J9rP2Luj8gsVj28Lwh:4hlGK7uTkRMQ99IcdQsJqO",
      "content-type: application/json"
    ),
  ));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $result = json_decode($response, true);

    if (isset($result['result']) && is_array($result['result'])) {
        echo "<div class='weather-container' style='display:flex;'>";
        
        foreach ($result['result'] as $weatherData) {
            echo "<div class='card' style='border-style:solid; border-width: 1px; width: 200px; display: flex; flex-direction: column; align-items: center; margin-right: 10px;background-color: #F4B47A;'>
                    <p>" . $weatherData['date'] . "</p>
                    <p>" . $result['city'] . "</p>
                    <img src='" . $weatherData['icon'] . "' style='width: 100px; height: auto;'>
                    <p>" . $weatherData['degree'] . " / " . $weatherData['night'] . "</p>
                    <p>" . $weatherData['day'] . "</p>
                    <p>" . $weatherData['description'] . "</p>
                    <p>En Düşük: " . $weatherData['min'] . "</p>
                    <p>En Yüksek: " . $weatherData['max'] . "</p>
                </div>";
        }
    } else {
        echo "Hava durumu verisi yok";
    }
}
?>

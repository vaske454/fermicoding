<?php
//require 'model/DbConnection.php';


date_default_timezone_set('Europe/Belgrade');
$apiKey = '42edc93da664412ca69569d0d6894312';
$cityId = '3194360';
$url = "https://api.openweathermap.org/data/2.5/weather?id=" .$cityId.'&lang=en&units=metric&APPID='.$apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTemperature = isset($data->main->temp) ? $data->main->temp : '';
?>

<?php if ($currentTemperature && $user->is_logged_in()): ?>
<div class="weather-block">
    <p>Current temperature: <?php echo $currentTemperature . '&#176;C'; ?></p>
</div><!-- .weather-block -->
<?php endif; ?>

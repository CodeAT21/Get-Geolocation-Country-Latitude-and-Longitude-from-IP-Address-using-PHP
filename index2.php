<?php
// IP address
$ip = '162.222.178.77';
$URL = 'https://freegeoip.app/json/'.$ip;

// Create a new cURL resource with URL
$curl = curl_init($URL);

// Return response instead of outputting
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute API request
$returnData  = curl_exec($curl);

// Close cURL resource
curl_close($curl);

// Retrieve IP data from API response
$ipJsonInfo = json_decode($returnData , true);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<title>Get Geolocation from IP Address using PHP by CodeAT21</title>
<link rel="stylesheet" href="style.css">
<meta charset="utf-8">
</head>
<body>

<div class="wrapper">
<div class="container">
<div class="form">
<h3>Geolocation Information:</h3>
<?php
if(!empty($ipJsonInfo)){
	$country_name = $ipJsonInfo['country_name'];
	$country_code = $ipJsonInfo['country_code'];
	$region_code = $ipJsonInfo['region_code'];
	$region_name = $ipJsonInfo['region_name'];
	$city = $ipJsonInfo['city'];
	$zip_code = $ipJsonInfo['zip_code'];
	$latitude = $ipJsonInfo['latitude'];
	$longitude = $ipJsonInfo['longitude'];
	$time_zone = $ipJsonInfo['time_zone'];
	
	echo '<p><b>Country Name:</b> '.$country_name.'</p>';
	echo '<p><b>Country Code:</b> '.$country_code.'</p>';
	echo '<p><b>Region Code:</b> '.$region_code.'</p>';
	echo '<p><b>Region Name:</b> '.$region_name.'</p>';
	echo '<p><b>City:</b> '.$city.'</p>';
	echo '<p><b>Zipcode:</b> '.$zip_code.'</p>';
	echo '<p><b>Latitude:</b> '.$latitude.'</p>';
	echo '<p><b>Longitude:</b> '.$longitude.'</p>';
	echo '<p><b>Time Zone:</b> '.$time_zone.'</p>';
}else{
	echo 'IP data is not found!';
}
?>
</div>
</div>
</div>
</body>
</html>
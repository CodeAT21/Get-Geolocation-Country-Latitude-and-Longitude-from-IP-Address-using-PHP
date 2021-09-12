<?php
$ipJsonInfo = array();
$statusMsg = '';

if(isset($_POST['submit'])){
	$statusMsg = 'Geolocation Information:';
	$userIP = $_POST['ip_address'];
	$ipJsonInfo = getIPLocation($userIP);
}

function getIPLocation($ip){
	$addApiURL = 'https://freegeoip.app/json/'.$ip;
	
	// Make HTTP GET request using cURL
	$curl = curl_init($addApiURL);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$returnData  = curl_exec($curl);
	if($returnData  === FALSE) {
        $msg = curl_error($curl);
        curl_close($curl);
        return false;
    }
	curl_close($curl);
	
	// Retrieve IP data from API response
	$ipJsonInfo = json_decode($returnData , true);
	
	// Return geolocation data
	return !empty($ipJsonInfo)?$ipJsonInfo:false;
}
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
	<form method="post" >
		<label> IP Address: </label>
		<input type="text" name="ip_address" value="<?php echo !empty($userIP)?$userIP:$_SERVER['REMOTE_ADDR']; ?>" required>
		<input type="submit" name="submit" value="Get Geolocation Data" class="btn">
	</form>
	
	<?php if(!empty($statusMsg)){ ?>
		<h2><?php echo $statusMsg; ?></h2>
	<?php
		if(!empty($ipJsonInfo)){
			$country_code = $ipJsonInfo['country_code'];
			$country_name = $ipJsonInfo['country_name'];
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
			echo '<p>IP data is not found!</p>';
		}
	 } 
	 ?>
</div>
</div>
</div>
</body>
</html>
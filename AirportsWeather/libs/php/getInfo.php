<?php
error_reporting(0);
	$executionStartTime = microtime(true) / 1000;

	
	header('Content-Type: application/json; charset=UTF-8');


	$airports = [
		'north' => 'EGPH',
		'south' => 'EGLL',
		'west' => 'EGGD',
		'east' => 'EGNX'
	];
	
	$dataToReturn = [
		'north' => '',
		'south' => '',
		'west' => '',
		'east' => ''
	];
	$urlBase = 'http://api.geonames.org/weatherIcaoJSON?username=belekasvito&ICAO=';

	foreach($airports as $which => $airportCode){
		$url = $urlBase . $airportCode;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);

		$result=curl_exec($ch);

		curl_close($ch);
		
		$decoded = json_decode($result, true);
		
		//possible options:
		//tempeture
		//humidity
		//windspeed
		
		$weatherObservation = $decoded['weatherObservation'];

		$humidity = $weatherObservation['humidity'];
		$temperature = $weatherObservation['temperature'];
		$windspeed = $weatherObservation['windSpeed'];

		$whatToFetch = $_GET[$which];
		if($_GET[$which]=='windspeed'){
			$whatToFetch = 'windSpeed';
		}
		$dataToReturn[$which] = (string)$weatherObservation[$whatToFetch];
	}
	echo json_encode($dataToReturn); 





// 
?>

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
		$contents = file_get_contents($url);
		
		$decoded = json_decode($contents, true);
		
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

//East lng + x West lng -x North lat+y Sout lat-y 
//bottom left corner
//lat: 51.323407
//lng: -0.526449

//lat:51.681651
//lng:0.177870

//luton (north): EGGW
//gatwick(south): EGKK
//heathrow (west): EGLL
//london city airport (east): EGLC



// 
?>

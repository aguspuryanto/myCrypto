<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$cache_file = 'data.json';
$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?start=1&limit=5000&convert=USD';

$filemtime 	= @filemtime($cache_file);
// $bytes = filesize($cache_file); echo $bytes;
if(!file_exists($cache_file) || (time() - $filemtime > 3600)){
// if((time() - $filemtime > 3600 || $bytes == 0)){
	$html = wp_remote_curl($url);
	file_put_contents($cache_file, $html);
}

$api_response = file_get_contents($cache_file);
$json_response = json_decode($api_response, true);
echo json_encode($json_response);

function wp_remote_curl($url){
	
	$api_key = '90058ea6-90d3-400c-a31e-821ea817f70e';
	// echo $api_key;

	// $request_headers = array();
	// $request_headers[] = 'X-CMC_PRO_API_KEY: '. $api_key;

	/*$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_HEADER, $request_headers );
    curl_setopt($ch, CURLOPT_ENCODING , "");
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 500); //timeout in seconds
	$result = curl_exec($ch);*/

	//Server url
	$headers = array(
	    'CMC_PRO_API_KEY: '.$api_key
	);
	// Send request to Server
	$ch = curl_init($url);
	// To save response in a variable from server, set headers;
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	// Get response
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}
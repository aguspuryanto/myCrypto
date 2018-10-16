<?php
include('API.php'); //https://github.com/moralesgersonpa/exchanges-php/blob/master/class/API.php
/**
 * Get list all cryptocurrencies
 * @var CoinsUrl is the url of the request
 * @var APIREST initializes the APIREST class
 * @var CallCoins list all cryptocurrencies, X-CMC_PRO_API_KEY is required by CoinMarketCap
 * @var the Api key provided by CoinMarketCap
 */

$cache_file = 'data_'.date('Ymd').'.json';

$start = isset($_GET['start']) ? $_GET['start'] : 1;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 100;
$convert = isset($_GET['convert']) ? $_GET['convert'] : "USD";

$filemtime 	= @filemtime($cache_file);
// $bytes = filesize($cache_file); echo $bytes;
if(!file_exists($cache_file) || (time() - $filemtime > 3600)){

	$ApiKey='90058ea6-90d3-400c-a31e-821ea817f70e';

	// https://api.coinmarketcap.com/v1/ticker/?convert=USD&limit=500
	$CoinsUrl='https://api.coinmarketcap.com/v2/ticker';
	// $CoinsUrl='https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
	$CoinsUrl .='?start='.$start.'&limit='.$limit.'&convert='.$convert;
	// echo ($CoinsUrl); die();

	$APIREST = new APIREST($CoinsUrl);
	// $CallCoins= $APIREST->call(
	// 	array('X-CMC_PRO_API_KEY:'.$ApiKey)
	// );
	// echo $CallCoins;
	file_put_contents($cache_file, $CallCoins);
}

$api_response = file_get_contents($cache_file);
$json_response = json_decode($api_response, true);
echo json_encode($json_response);

// Get metadata
// https://pro-api.coinmarketcap.com/v1/cryptocurrency/info

// List all cryptocurrencies (historical)
// https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/historical
// https://coinmarketcap.com/currencies/ripple/historical-data/
// ?start=20180716&end=20181016 
// ?start=20180916&end=20181016

// https://changelly.com/exchange/btc/xrp/1
// https://changelly.com/?ref_id=4e7irkav862o75cv

// https://www.ccn.com/marketcap/

        // <iframe
        //   src="https://changelly.com/widget/v1?auth=email&from=USD&to=XRP&merchant_id=4e7irkav862o75cv&address=&amount=100&ref_id=4e7irkav862o75cv&color=00cf70"
        //   width="600"
        //   height="500"
        //   class="changelly"
        //   scrolling="no"
        //   style="overflow-y: hidden; border: none"
        // >
        //   Can't load widget
        // </iframe>

?>
<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

include_once ('simple_html_dom.php');

$date = new DateTime(); // For today/now, don't pass an arg.
// echo $date->format("Y-m-d H:i:s");

$start = isset($_GET['start']) ? $_GET['start'] : $date->modify("-1 day");
$end = isset($_GET['end']) ? $_GET['end'] : $date->modify("-1 years");
$convert = isset($_GET['convert']) ? $_GET['convert'] : "bitcoin";

$cache_file = $convert.'_historical_'.date('Ymd').'.html';

$filemtime 	= @filemtime($cache_file);
// $bytes = filesize($cache_file);
if(!file_exists($cache_file) || (time() - $filemtime > 3600) || filesize($cache_file) < 390){

	$CoinsUrl='https://coinmarketcap.com/currencies/'.$convert.'/historical-data/?start=20171016&end=20181016';
	// echo $CoinsUrl;  die();	
	$CallCoins = @file_get_contents($CoinsUrl, true, stream_context_create(
		array('http' => array(
			'ignore_errors' => true
		))
	));	
	// echo $CallCoins;
	$CallCoins 	= preg_replace('#<script(.*?)>(.*?)</script>#is', '', $CallCoins);
	file_put_contents($cache_file, $CallCoins);
}

$html = str_get_html( file_get_contents($cache_file) );

foreach($html->find('table>tbody>tr') as $e) {
	$historical['date'] = $e->find('td',0)->plaintext;
	$historical['open'] = $e->find('td',1)->plaintext;
	$historical['high'] = $e->find('td',2)->plaintext;
	$historical['low'] = $e->find('td',3)->plaintext;
	$historical['close'] = $e->find('td',4)->plaintext;
	$historical['volume'] = $e->find('td',5)->plaintext;
	$historical['marketcap'] = $e->find('td',6)->plaintext;
	
	if(!empty($historical['date'])) $data[] = $historical;
}

$html->clear();
unset($html);

$data = array_filter($data);
echo json_encode($data);

// Get metadata
// https://pro-api.coinmarketcap.com/v1/cryptocurrency/info

// List all cryptocurrencies (historical)
// https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/historical
// https://coinmarketcap.com/currencies/ripple/historical-data/
// ?start=20180716&end=20181016 
// ?start=20180916&end=20181016

// https://changelly.com/exchange/btc/xrp/1
// https://changelly.com/?ref_id=4e7irkav862o75cv


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

/*Program Investasi: Bitconnect

Dompet BTC: VIP Bitcoin
Modal Investasi: $ 510
Tanggal Investasi: 22 Agustus 2017
Withdraw Profit: BTC 0.0064
Profit Investasi: $ 293.15 (57.48%)
Lama Investasi Berjalan Hingga Saat Ini: 64 hari*/

// https://coinmarketcap.com/converter/xrp/idr/?amt=1

    /*$apiKey = 'YOUR_API_KEY';
    $apiSecret = 'YOUR_API_SECRET';
    $apiUrl = 'https://api.changelly.com';
    $message = json_encode(
        array('jsonrpc' => '2.0', 'id' => 1, 'method' => 'getCurrencies', 'params' => array())
    );
    $sign = hash_hmac('sha512', $message, $apiSecret);
    $requestHeaders = [
        'api-key:' . $apiKey,
        'sign:' . $sign,
        'Content-type: application/json'
    ];
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
    
    $response = curl_exec($ch);
    curl_close($ch);
    var_dump($response);*/

    // <iframe src="https://changelly.com/widget/v1?auth=email&from=USD&to=BTC&merchant_id=4e7irkav862o75cv&address=&amount=1&ref_id=4e7irkav862o75cv&color=00cf70" width="600" height="500" class="changelly" scrolling="no" style="overflow-y: hidden; border: none" > Can't load widget </iframe>

    // https://changelly.com/exchange/BTC/XRP/1?ref_id=4e7irkav862o75cv&cmcref=listing
?>
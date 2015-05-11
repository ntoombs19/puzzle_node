<?php

$rates = getXMLFile("data/RATES.xml");
$transactions = getCSVFile("data/TRANS.csv");

$solution = array();
$output = "";

$ratesArray = array();
foreach ($rates as $rate){
    $from=$rate->from;
    $to=$rate->to;
    $conversion=$rate->conversion;
    $key = "{$from}-{$to}";
    $ratesArray[$key] = floatval($conversion);
}
$rates = $ratesArray;


for($i = 1; $i < count($transactions); $i++){
	$store = $transactions[$i][0];
	$sku = $transactions[$i][1];
	$amount= $transactions[$i][2];

    if (!isset($solution[$sku])) {
        $solution[$sku] = array(0 => convert($amount));
    } else {
        array_push($solution[$sku], convert($amount));
    }
}

$output = $output . number_format(array_sum($solution["DM1182"]), 2, '.', '');
file_put_contents("output.txt", $output);

function bankers_round($x) { 
	if ((floor($x*1000)-(10*floor($x*100))) > 4) { 
		return ((floor($x*100)+1)/100); 
	} 
	else { 
		return (floor($x*100)/100); 
	} 
}  

function convert($price){
	global $rates;
	$price = explode(" ", $price);
	$denomination = $price[1];
	$price = $price[0];
	if($denomination == "EUR"){//EUR-AUD
		$price = $price * $rates["EUR-AUD"];
		$denomination = "AUD";
	}
	if($denomination == "AUD"){//AUD-CAD
		$price = $price * $rates["AUD-CAD"];
		$denomination = "CAD";
	}
	if($denomination == "CAD"){//CAD-USD
		$price = $price * $rates["CAD-USD"];
		$denomination = "USD";
	}
	if($denomination == "USD"){
		return bankers_round($price);
	}
}

function getXMLFile($fileName){
	if (file_exists($fileName)) {
	    $xml = simplexml_load_file($fileName);
	} 
	else {
		echo "{$fileName} doesn't exist";
	}
	return $xml;
}

function getCSVFile($fileName){
	if (file_exists($fileName)) {
		$csv = array_map('str_getcsv', file($fileName));
	} 
	else {
		echo "{$fileName} doesn't exist";
	}
	return $csv;
}
?>
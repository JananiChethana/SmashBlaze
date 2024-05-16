<?php 

$amount = 3000;
$merchant_id = '1226542';
$order_id =  uniqid();
$merchant_secret ="MzY2Nzk4MjcxODUyOTc0MTcwNjM4NDMwNzg0MzEzNDEzNTEzNjI=";
$currency = 'LKR';



$hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        number_format($amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);

$array = [];
$array ["items"] = "Racket";
$array ["first_name"] = "Chethana";
$array ["last_name"] = "Thanthirige";
$array ["email"] = "chethana@gmail.com";
$array ["phone"] = "0771234567";
$array ["address"] = "No 1, Galle Road";
$array ["city"] = "Colombo";
$array ["country"] = "Sri Lanka";
$array ['amount'] = $amount;
$array['order_id'] = $order_id;
$array['merchant_id'] = $merchant_id;
$array['currency'] = $currency;
$array['hash'] = $hash;

$jsonObj = json_encode($array);
echo $jsonObj;


?>
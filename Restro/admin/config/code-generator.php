<?php

//---------Barcode Generator-------------------------------------------//
$length = 13; // Standard barcode length
$barcode = substr(str_shuffle("12345678901234567890"), 1, $length);

$alpha = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);
$beta = rand(1000, 9999);

$checksum= bin2hex(random_bytes('12'));
$operation_id = bin2hex(random_bytes('4'));
$cus_id = bin2hex(random_bytes('6'));
$prod_id  = bin2hex(random_bytes('5'));
$orderid = bin2hex(random_bytes('5'));
$payid = bin2hex(random_bytes('3'));


?>
<?php
include_once 'qrcode/qrlib.php';
$id = 1;
$filename = "uploadFiles/qr/$id.png";
QRcode::png("https://YOURWEBSITE.COM/News/$id", $filename);
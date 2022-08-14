<?php
include "qrcode/qrcode/qrlib.php";
require "_load.php";
//create qrcode

//global $db;
//$query="select * from resturan ";
//$stmt=$db->prepare($query);
//$stmt->execute();
//$rests=$stmt->fetchAll(PDO::FETCH_ASSOC);
//
//foreach ($rests as $rest) {
//    QRcode::png("http://localhost/restaurant/?rest_url=".$rest['rest_url'],"rest_qr/".$rest['rest_url'].".png");
//}

$resturan=get_rest_by_rest_id($_SESSION['rest_id']);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin_QrCode</title>
</head>
<body>
<div style="width:100%;height:100%;display: flex;flex-direction: column;justify-content: center;align-items: center;">
    <div style="display: flex;flex-direction: column">
        QrCODE _<?=$resturan['name']?>
        <img src="rest_qr/<?=$resturan['rest_url']?>.png" style="width: 500px;height: 500px">
    </div>

</div>
</body>
</html>
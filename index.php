<?php
require "_load.php";
if (isset($_GET['rest_url'])){
    $resturan=get_rest_name($_GET['rest_url']);
    $foods=get_food($resturan['id']);
    if (count($foods)==0){
        $no_food=1;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="cssTest.css">
</head>
<body>

<ul class="nav">
    <label class="nav_icon"><img src="front_image/icon1.png">

        <label>     <label>A s e r z T i m e</label>

            <label>سامانه غذا</label><?=$resturan['name']?>
        </label>
    </label>


</ul>

<div >
    <?php if (isset($no_food)){ ?>
        <label style="background-color: #1a101f;color: #cfefef;width: 25px;height: 25px;font-size: xxx-large"> <b>is not any food</b></label>
    <?php }  ?>
    <?php foreach ($foods as $food){ ?>
     <?php   if(isset($falg_delete)){?>
            <label style="font-size: xxx-large;font-family: Arial">is deleted</label>

       <?php } ?>
        <div name="menu" class="menu">
            <img class="image" src="<?=$food['img']?>">
            <label class="food_inf">
                <label class="name_food">
                    <?=$food['name']?>
                </label>
                <label class="price_food">
                    price:   <?=number_format($food['price'])?>
                </label>
                <label class="available_food">
                    available
                </label>



            </label>
        </div>
    <?php } ?>
</div>
</body>
</html>
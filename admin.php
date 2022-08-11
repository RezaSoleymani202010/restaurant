<?php
require "_load.php";
checkAuth();
$user=$_SESSION['user'];
$rest_id=$_SESSION['rest_id'];
$resturan=get_rest_by_rest_id($rest_id);
$rest_name=$resturan['name'];
$foods=get_food($rest_id);
if (count($foods)<1){
    $no_food=1;
}
if (isset($_POST['delete'])){
    $food=get_food_by_fod_id($_POST['food']);
   if ($food['img']!=="")
    unlink($food['img']);
    if(delete_food($_POST['food'])==1){
        redirect("admin.php");
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
    <label class="nav_icon"><img  src="img/icon2.png" >
        <label>     <label>A s e r z T i m e</label>

            <label>سامانه غذا</label><?=$resturan['name']?>
        </label>
    </label>
<a class="nav_item" href="create_food.php">create Food</a>

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
                    price:   <?=$food['price']?>
                </label>
                <label class="available_food">
                    available
                </label>
                <form style="display: flex;margin-left: 5px" action="update_food.php" method="post">
                <input type="submit" value="update" class="update">
                    <input name="food" type="hidden" value="<?=$food['id']?>"
                    </input>
                </form>
                <form style="display: flex;margin-left: 5px" action="" method="post">
                    <input name="delete" type="submit" value="delete" class="delete">
                    <input name="food" type="hidden" value="<?=$food['id']?>"
                    </input>
                </form>

            </label>
        </div>
    <?php } ?>
</div>
</body>
</html>
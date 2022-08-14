<?php
require "_load.php";
if (isset($_POST['food'])){
  $food=get_food_by_fod_id($_POST['food']);

}

if (isset($_POST['new_name'],$_POST['new_price'],$_POST['available'])) {
    $food = get_food_by_fod_id($_POST['hidden_food']);
    $new_img=$food['img'];
    if (isset($_FILES['img'])) {
        if (file_exists($_FILES['img']['tmp_name'])) {
            if ($food['img']!=="") unlink($food['img']);

            $path = "food_img/" . $_FILES['img']['name'];
            if (move_uploaded_file($_FILES['img']['tmp_name'], $path)) {
                $new_img = $path;
            }
        }
    }
    $new_name = $_POST['new_name'];
    $new_price = $_POST['new_price'];
    $new_available = $_POST['available'];
    $food_id = $food['id'];
    update_food($food_id, $new_name, $new_price, $new_img, $new_available);
    redirect("admin.php");
}
$resturan=get_rest_by_rest_id($_SESSION['rest_id']);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update-Food<?= $resturan['name'] ?></title>
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

<div class="container" >

    <form  action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="hidden_food" value="<?=$food['id']?>">
        <img class="img_update" src="<?=$food['img']?>">
        <label >
            <label style="font-size:x-large;font-weight: bold ">Update</label><br><br>
            <input placeholder="new name" class="input_form" type="text" name="new_name">
            <input placeholder="new price" class="input_form"  type="text" name="new_price">
            <label class="input_checkbox">
                          <label for="available">Available</label>
                          <input name="available" type="radio" id="available"  value="1">
            </label>
            <div class="load_img">
                <label  >chose new img</label>
                <input name="img"   type="file" >
            </div>

            <input type="submit" class="input_form" value="Save changes" style="background-color: #66ffd4">
        </label>
    </form>
</div>
</body>
</html>

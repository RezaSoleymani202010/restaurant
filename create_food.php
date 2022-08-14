<?php
require "_load.php";
$rest_id=$_SESSION['rest_id'];
$resturan=get_rest_by_rest_id($rest_id );
if (isset($_POST['name'],$_POST['price'],$_POST['available'],$_FILES['img']))
{
    if (file_exists($_FILES['img']['tmp_name'])){
        $path="food_img/";
        $path.=$_FILES['img']['name'];
        if (move_uploaded_file($_FILES['img']['tmp_name'],$path)){
            $name=$_POST['name'];
            $img=$path;
            $price=$_POST['price'];
            $available=$_POST['available'];
            create_food($name,$price,$available,$img,$rest_id);
            redirect("admin.php");
        }
    }else exit("Please chose img  correctly or fill in all fields correctly ");
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Food-<?= $resturan['name'] ?></title>
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

<div class="create_food" >

    <form  action="" method="post" enctype="multipart/form-data">
<!--        <label style="font-family: Arial;font-size: xx-large;">Create Food</label>-->
        <label >

            <input placeholder=" name" class="input_form" type="text" name="name">
            <input placeholder=" price" class="input_form"  type="text" name="price">

            <div class="input_checkbox">
                    <label for="available">Available</label>
                    <input value="1" name="available" type="checkbox" id="available" />
            </div>

            <label class="load_img">
                <label>choose img</label>
                <input name="img"   type="file" >
            </label>

            <input name="submit" type="submit" class="submit_form" value="Save changes" >
        </label>
    </form>
</div>
</body>
</html>

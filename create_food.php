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


</ul>

<div class="create_food" >
    <form  action="" method="post" enctype="multipart/form-data">

        <label >
            <input placeholder=" name" class="input_form" type="text" name="name">
            <input placeholder=" price" class="input_form"  type="text" name="price">
            <label class="input_radio">
                <div>
                    <label for="available">Available</label>
                    <input name="available" type="radio" id="available"  value="1">

                </div>
                <div>
                    <label for="NotAvailable">NotAvailable</label><br>
                    <input name="available" type="radio" id="NotAvailable"  value="0">
                </div>
            </label>
            <div class="load_img">
                <label  >chose img for food</label>
                <input name="img"   type="file" >
            </div>
            <input name="submit" type="submit" class="submit_form" value="Save changes" >
        </label>
    </form>
</div>
</body>
</html>

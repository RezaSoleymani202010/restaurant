<?php
require "_load.php";
$rests=get_resturan();
if (isset($_POST['username'],$_POST['rest_name'],$_POST['password'])){
   $username=$_POST['username'];
   $password=$_POST['password'];
   $rest_id=$_POST['rest_name'];

   $login=login_rest($username,$password,$rest_id);
   if ($login!==0){
       $_SESSION['user']=$username;
       $_SESSION['rest_id']=$rest_id;
redirect("admin.php");
   }
   else
   {
       echo "request not find";
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
    <label class="nav_icon"><img src="img/icon2.png">
        <label> <label>A s e r z T i m e</label>

            <label> مرجع دانلود بیت</label>
        </label>
    </label>


</ul>

<div class=" flex_container">
    <form method="post" action="">

        <div class="form">
            <labal class="login_name">Login</labal>
            <input name="username" placeholder="user name" type="text" class="input_form">
            <?php if (isset($_SESSION['error'])) { ?>
                <label name="error"><?= $_SESSION['error'] ?></label>
            <?php } ?>
            <label class="rest_input"><label class="rest_name">restaurant name:</label>
            <select class="rest_select" name="rest_name" >
                <?php foreach ($rests as $rest){ ?>
                <option  value="<?=$rest['id']?>"><?=$rest['name']?></option>
                <?php } ?>
            </select>
            </label>
            <input name="password" placeholder="password" type="text" class="input_form">
            <input type="submit" class="submit_form" value="Let me in">
<!--            <label class="footer_form" style="display: flex;flex-direction: row"><label style="font-family: Aldhabi;font-size:xx-large">you have no account?  &nbsp;</label>-->
<!---->
<!--         <a href="register.php" style="display: flex;width: 160px;-->
<!--         justify-content: center;border-radius: 10px;-->
<!--         border-style: none;  flex-direction:row;background-color:#164937;-->
<!--         color: #cfefef;text-decoration:none;-->
<!--         font-family: 'Arial', 'Bahnschrift'; font-size: large;-->
<!--         height: 30px;align-items: center" >create account</a>-->
<!---->
<!--     </label>-->

        </div>
    </form>
</div>
</body>
</html>
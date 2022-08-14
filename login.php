<?php
require "_load.php";

$rests = get_resturan();

if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rest_id = get_rest_id_by_username_password($username, $password)['id'];
    $login = login_rest($username, $password);

    if ($login !== 0) {
        $_SESSION['user'] = $username;
        $_SESSION['rest_id'] = $rest_id;
        redirect("admin.php");

    }
    else {
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
    <title>Admin-Login</title>

    <link rel="stylesheet" href="cssTest.css">
</head>


<body>

<ul class="nav">
    <label class="nav_icon">
        <img src="front_image/icon1.png">
        <label>
            <label>A s e r z T i m e</label>
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

            <input name="password" placeholder="password" type="text" class="input_form">
            <input type="submit" class="submit_form" value="Let me in">

        </div>
    </form>
</div>
</body>
</html>
<?php
session_start();
try {
    $db=new PDO("mysql:host=localhost;dbname=resturan","root","");
}catch (PDOException $error){
    echo "not connected";
}

function checkAuth(){
    if (!isset($_SESSION['user'])){
        header("Location: "."login.php");
        exit();
    }
}
function redirect($path){
    header("Location: ".$path);
    exit();
}
function login_rest($username,$password,$rest_id){
    global $db;
    $query="select * from resturan where username=:username and password=:password and id=:id";
    $stmt=$db->prepare($query);
    $stmt->bindParam("username",$username);
    $stmt->bindParam("password",$password);
    $stmt->bindParam("id",$rest_id);
    $stmt->execute();
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    if ($result!==false){
        return 1;
    }else{
        return  0;
    }
}
function register_user($username,$phone_number,$rest_id,$password,$confirm_password){
    if ($password===$confirm_password) {
        global $db;
        $query = "insert into user(username,phone_number,rest_id,password)values (:username,:phone_number,:rest_id,:password)";
        $stmt = $db->prepare($query);
        $stmt->bindParam("username", $username);
        $stmt->bindParam("phone_number", $phone_number);
        $stmt->bindParam("rest_id", $rest_id);
        $stmt->bindParam("password", $password);
        $stmt->execute();
        return 1;
    }
    else
        return 0;
}

function get_resturan(){
    global $db;
    $query="select id, name from resturan";
    $stmt=$db->prepare($query);
    $stmt->execute();
    $resturan=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resturan;
}
function get_rest_id_by_username($username){
    global $db;
    $query="select rest_id from user where username=?";
    $stmt=$db->prepare($query);
    $stmt->bindParam(1,$username);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);

}
function get_rest_name($rest_url){
    global $db;
    $query="select * from resturan where rest_url=:rest_url";
    $stmt=$db->prepare($query);
    $stmt->bindParam("rest_url",$rest_url);
    $stmt->execute();
    $resturan=$stmt->fetch(PDO::FETCH_ASSOC);
    return $resturan;
}
function get_rest_by_rest_id($rest_id){
    global $db;
    $query="select * from resturan where id=:id";
    $stmt=$db->prepare($query);
    $stmt->bindParam("id",$rest_id);
    $stmt->execute();
    $resturan=$stmt->fetch(PDO::FETCH_ASSOC);
    return $resturan;
}
function get_rest_url($rest_id){
    global $db;
    $query="select * from resturan where id=:id";
    $stmt=$db->prepare($query);
    $stmt->bindParam("id",$rest_id);
    $stmt->execute();
    $resturan=$stmt->fetch(PDO::FETCH_ASSOC);
    return $resturan;
}
function get_food($resturan_id){
    global $db;
    $available=true;
    $query="select * from food where rest_id=:resturan_id and available=:available";
    $stmt=$db->prepare($query);
    $stmt->bindParam("resturan_id",$resturan_id);
    $stmt->bindParam("available",$available);
    $stmt->execute();
    $foods=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $foods;
}
function get_food_by_fod_id($food_id){
    global $db;
    $query="select * from food where id=:food_id";
    $stmt=$db->prepare($query);
    $stmt->bindParam("food_id",$food_id);
    $stmt->execute();
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function update_food($food_id,$new_name,$new_price,$new_img,$new_available){
    global  $db;
    $query="update food set name=:new_name , price=:new_price ,img=:new_img, available=:new_available where id=:food_id";
    $stmt=$db->prepare($query);
    $stmt->bindParam("new_name",$new_name);
    $stmt->bindParam("new_price",$new_price);
    $stmt->bindParam("new_img",$new_img);
    $stmt->bindParam("new_available",$new_available);
    $stmt->bindParam("food_id",$food_id);
    $stmt->execute();
}
function create_food($name,$price,$available,$img,$rest_id){
    global $db;
    $query="insert into food (name,price,img,available,rest_id) values (:name,:price,:img,:available,:resturan_id)";
    $stmt=$db->prepare($query);
    $stmt->bindParam("name",$name);
    $stmt->bindParam("price",$price);
    $stmt->bindParam("img",$img);
    $stmt->bindParam("available",$available);
    $stmt->bindParam("resturan_id",$rest_id);
    $stmt->execute();
}
function delete_food($food_id){
    global $db;
    $food=get_food_by_fod_id($food_id);
        unlink($food['img']);
    $query="delete from food where id=:food_id";
    $stmt=$db->prepare($query);
    $stmt->bindParam(":food_id",$food_id);
    if ($stmt->execute()){
        return 1;
    }
    else return 0;
}
function save_as($name,$code){
    global $db;
    $query="insert into asab (name,code)values (:name,:code)";
 $stmt=$db->prepare($query);
 $stmt->bindParam(":name",$name);
 $stmt->bindParam(":code",$code);
 $stmt->execute();

}
function get_user($user_id){
    global $db;
    $query="select * from user where id=:user_id";
    $stmt=$db->prepare($query);
    $stmt->bindParam("user_id",$user_id);
    $stmt->execute();
    $user=$stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}
function get_rest_by_username($username){
    global $db;
    $query="select * from resturan where username=?";
    $stmt=$db->prepare($query);
    $stmt->bindParam(1,$username);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
if (isset($_SESSION['user'])){
    $user=get_rest_by_username($_SESSION['user']);
    if ($user==false){
        unset($_SESSION['user']);
        header("Location: "."login.php");
        exit();
    }
}

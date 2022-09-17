<?php
if($_SERVER['REQUEST_URI'] == "/blog/app/models/Connect.php"){
  header("location:/blog/app/pages/errors/404.html");
}

$serverName = "localhost";
$username = "root";
$password = "";

$connection = new mysqli($serverName,$username,$password,"blog");

if($connection->connect_error){
  $_SESSION['error'] = "اتصال با دیتابیس با مشکل مواجه شده است";
}

function show_text($value = null){
  $result = $value;
  
  return substr($result,0,70);;
}

?>

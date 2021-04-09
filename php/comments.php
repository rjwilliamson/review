<?php 
require_once("../includes/functions.php");
require_once("connect.php");
$comment = $_POST['commentBox'];
$url = $_POST['url'];

   $cookie = $_COOKIE['user'];

    $stmt = $conn->prepare("SELECT username FROM users WHERE cookie=:cookie");
    $stmt->bindParam(":cookie",$cookie);
    $stmt->execute();

   $username = $stmt->fetch(PDO::FETCH_OBJ);



$insert = $conn->prepare("INSERT INTO comments (body,comment_on,username) VALUES(:body,:comment_on,:username)");
$insert->bindParam(":body",$comment);
$insert->bindParam(":comment_on",$url);
$insert->bindParam(":username",$username->username);
$insert->execute();

getComments($conn,$url);



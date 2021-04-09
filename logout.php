<?php 
require_once("php/connect.php");
if(isset($_COOKIE['user'])){
    $userCookie = $_COOKIE['user'];
    $null = null;
	$deleteCookie = $conn->prepare("UPDATE users SET cookie = :nothing WHERE cookie = :cookie");
	$deleteCookie->bindParam(":nothing",$null);
	$deleteCookie->bindParam(":cookie",$userCookie);
	$deleteCookie->execute();
	setcookie("user",'',time()-3600,'/');
	header("Location:./");

	
}


?>
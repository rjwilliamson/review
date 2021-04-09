<?php 
require_once("../includes/functions.php");
require_once("connect.php");

$url = $_POST['url'];
getCommentCount($conn,$url);
?>
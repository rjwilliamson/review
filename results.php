<?php 
if(empty($_COOKIE['user'])){
	header("Location:./");
}

if(isset($_GET['q'])){
    
    $companyName = str_replace("-", " " ,$_GET['q']);
	require_once("includes/results_page.php");
}else{

	header("Location:home.php");
}

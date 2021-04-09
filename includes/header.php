<?php session_start(); ?>
<?php 
error_reporting(E_ALL);
    ini_set('display_errors', 'On');

    ?>
<?php require_once("php/connect.php"); ?>
<?php require_once("includes/functions.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="assets/css/reset.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<title>Document</title>
</head>
<body>
	
<header>
	<h1>Delivery Review</h1>
</header>

<?php if(isset($_COOKIE['user'])): ?>
<nav>
	<ul>
		<li><a href="./">Home</a></li>
		<li><a href="account.php?id=<?php echo user($conn,'id')?>"><?php echo user($conn,'username'); ?></a></li>
        <li><a href="logout.php">Logout</a></li>

</ul>

</nav>

<?php endif; ?>
<?php 

if(empty($_COOKIE['user'])){
	header("Location:./");
}

?>

<?php require_once('includes/header.php'); ?>



<div id="search-container">
	<form action="" method="POST">

	<input type="search" id="search" placeholder="Company Name">
	
	</form>

	<div id="search_results"></div>

</div>
<script src="assets/js/search.js"></script>
<?php require_once('includes/footer.php'); ?>
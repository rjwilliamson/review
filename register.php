<?php  
if(isset($_COOKIE['user'])){
	header("location:home.php");
}
?>
<?php require_once('includes/header.php'); ?>
<?php require_once("php/register.php"); ?>



<div class="form-container">
<form action="" method="post">
	
	<input type="text" name="rusername" placeholder="Username">
	<input type="password" name="rpassword" placeholder="Password">
	<input type="email" name="email" placeholder="Email">
	<input type="submit" name="rsubmit" value="Register">
	<a href="./">Already have an account? login here</a>
    
    <?php foreach($errors as $err): ?>
    <div class="form_page_errors">
       <p> <?php echo $err;  ?> </p>
    </div>

    <?php endforeach;   ?>



</form>

<?php require_once('includes/footer.php'); ?>
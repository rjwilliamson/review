<?php  
if(isset($_COOKIE['user'])){
	header("location:home.php");
}
?>

<?php require_once('includes/header.php'); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("php/connect.php"); ?>
<?php require_once("php/login.php"); ?>

<?php if(isset($_SESSION['register_success'])): ?>

<section class="session_login_message">
  <h2><?php echo $_SESSION['register_success']; ?></h2>
  <?php session_destroy();  ?>
</section>
<?php endif; ?>


<?php if(isset($_SESSION['account_activated'])): ?>

<section class="session_login_message">
  <h2><?php echo $_SESSION['account_activated']; ?></h2>
  <?php session_destroy();  ?>
</section>
<?php endif; ?>

<div class="form-container">
<form action="" method="POST">
	
	<input type="text" name="lusername" placeholder="Username">
	<input type="password" name="lpassword" placeholder="Password">
	<input type="submit" name="lsubmit" value="Login">
	<a href="register.php">Dont have an account? register here</a>



</form>

<?php if(!empty($errors)): ?>
<div class="form_page_errors">
  <p><?php echo $errors; ?></p>
</div>
<?php endif; ?>
<?php require_once('includes/footer.php'); ?>
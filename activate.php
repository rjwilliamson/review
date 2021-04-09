<?php  
if(isset($_COOKIE['user'])){
	header("location:home.php");
}


?>

<?php require_once("includes/functions.php"); ?>
<?php require_once("php/connect.php"); ?>
<?php require_once('includes/header.php'); ?>

<?php  

$link = $_GET['verify'];
$one = 1;
$zero = 0;

$stmt = $conn->prepare("SELECT count(*) FROM users WHERE activation_link=:activation_link AND activated = :zero");
$stmt->bindParam(":activation_link",$link);
$stmt->bindParam(":zero",$zero);
$stmt->execute();

if($stmt->fetchColumn()> 0){
	
	$update = $conn->prepare("UPDATE users SET activated=:activated WHERE activation_link=:activation_link");
	$update->bindParam(":activated",$one);
	$update->bindParam(":activation_link",$link);
	$update->execute();

	if($update->execute() == 1){

		 header("Location:./");
		 $_SESSION['account_activated'] = "Your account has been activated you may now log in";

		 $delete = $conn->prepare("UPDATE users SET activation_link = :empty WHERE activation_link = :activation_link");
         
         $empty = "";
		 $delete->bindParam(":empty",$empty);
		 $delete->bindParam(":activation_link",$link);
		 $delete->execute();


	}
}else{
   
         header("Location:./");
		 

}



?>

<?php require_once('includes/footer.php'); ?>

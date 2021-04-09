<?php 

if(empty($_COOKIE['user'])){
	header("Location:./");
}

if(!isset($_GET['id'])){

	header("Location:home.php");
}

require_once("includes/functions.php");
require_once("php/connect.php");

$username = user($conn,'username');

$stmt = $conn->prepare("SELECT DISTINCT comment_on FROM comments WHERE username=:username");
$stmt->bindParam(":username",$username);
$stmt->execute();

if($stmt->rowCount() > 0){

	$count = $conn->prepare("SELECT COUNT(*) FROM comments WHERE username=:username");
	$count->bindParam(":username",$username);
	$count->execute();
	$count =  $count->fetchcolumn();

	

	while($get = $stmt->fetch(PDO::FETCH_OBJ)){
	   
	   $results[] = $get->comment_on;



	}

}else{

  $results = [];
  $count = 0;
}
?>


<?php require_once('includes/header.php'); ?>


<section id="accounts">


<p>
You have commented <?php echo $count < 2 ? $count." time" : $count." times" ?>

</p>

<ul>

	<?php foreach($results as $r):  ?>
      
     <li><a href="results.php?q=<?php echo $r ?>"><?php echo $r ?></a></li>
     <?php endforeach; ?>
</ul>



</section>




<?php require_once('includes/footer.php'); ?>


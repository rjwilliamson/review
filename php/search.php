<?php 
require_once("connect.php");
$search = $_POST['search'];
$stmt = $conn->prepare("SELECT name FROM places WHERE name LIKE :name");
$stmt->bindValue(":name","%".$search."%");
$stmt->execute();

if($stmt->rowCount() >0):

$results = $stmt->fetch(PDO::FETCH_OBJ);
$name =  strtolower(str_replace(" ", "-", $results->name));
?>

<a href="results.php?q=<?php echo$name ?>"><?php echo $results->name ?></a>
<?php else: ?>
<h3>No results found</h3>
<?php endif; ?>

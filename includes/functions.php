<?php 

function SanitizeFormString($input){
    
    $input = strip_tags($input);
    $input = str_replace(" ", "",$input);
    $input = strtolower($input);
    $input = ucfirst($input);

    return $input;
}


function getComments($conn,$url){
    

	$stmt = $conn->prepare("SELECT body,username FROM comments WHERE comment_on = :url ORDER BY id DESC");
	$stmt->bindParam(":url",$url);
	$stmt->execute();
    


	while($get = $stmt->fetch(PDO::FETCH_OBJ)){
    

	echo "<p id=comment_body>  <span> $get->username Said: </span>$get->body</p>";



	}
}


function getCommentCount($conn,$url){

      $stmt = $conn->prepare("SELECT COUNT(*) from comments WHERE comment_on=:url");
      $stmt->bindParam(":url",$url);
      $stmt->execute();

       $count = $stmt->fetchColumn();

       if($count < 2){
       	  echo "$count Comment";
       }else{
       	echo "$count Comments";
       }

       

	}


  function user($conn,$var){
     
     $cookie = $_COOKIE['user'];
     $stmt = $conn->prepare("SELECT * FROM users WHERE cookie = :cookie");
     $stmt->bindParam(":cookie",$cookie);
     $stmt->execute();

     $user = $stmt->fetch(PDO::FETCH_OBJ);
     return $user->$var;
  }




?>
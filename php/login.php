<?php 

$errors = "";

if(isset($_POST['lsubmit'])){

	$username = sanitizeFormString($_POST['lusername']);
	$password = $_POST['lpassword'];
	$cookie = bin2hex(openssl_random_pseudo_bytes(50));
    $expire = time() + 3600;
    $one = 1;

	$check = $conn->prepare("SELECT username,password,activated FROM users WHERE username=:username");
    $check->bindParam(":username",$username);
	$check->execute();
	

	

	if($check->rowCount() ==1){
	  $get = $check->fetch(PDO::FETCH_OBJ);
     if($get->activated ==0){
           
          $_SESSION['account_activated'] = "Please activate your account before logging in";
    }else{
    
			if($username == $get->username && $password = password_verify($password,$get->password)){
		          
		         setcookie("user",$cookie,$expire,'/',null,true,true);
		         $updateUserTableCookie = $conn->prepare("UPDATE users SET cookie = :cookie WHERE username = :username");
		         $updateUserTableCookie->bindParam(":cookie",$cookie);
		         $updateUserTableCookie->bindParam(":username",$username);
		         $updateUserTableCookie->execute();
				 header("Location:home.php");
			  }else{
			  	   
			  	   $errors = "Incorrect username or password";
			  }

		 }

	 

  }     


}

?>
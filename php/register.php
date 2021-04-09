<?php  
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

require_once("includes/functions.php");
require_once("connect.php");
$errors = [];
if(isset($_POST['rsubmit'])){

$username = SanitizeFormString($_POST['rusername']);
$password = $_POST['rpassword'];
$email = $_POST['email'];
$password_hashed = password_hash($password,PASSWORD_BCRYPT);
$zero = 0;
$usernameTaken= $conn->prepare("SELECT username FROM users WHERE username = :username");
$usernameTaken->bindParam(":username",$username);
$usernameTaken->execute();
$usernameTaken->fetch(PDO::FETCH_OBJ);

$activationLink = bin2hex(openssl_random_pseudo_bytes(25));


$emailTaken= $conn->prepare("SELECT email FROM users WHERE email = :email");
$emailTaken->bindParam(":email",$email);
$emailTaken->execute();
$emailTaken->fetch(PDO::FETCH_OBJ);



   if(empty($username)){

   	   $errors[] = "Username cant be empty";
   }

   if(empty($password)){

   	   $errors[] = "Password cant be empty";
   }

   else{

       
        if(strlen($username) < 4 || strlen($username) > 20){
   	  $errors[] =  "Username should be between 4-20 characters in length";
        }

        if(strlen($password) < 8 || strlen($password) > 20){

	       $errors[] = "Password should be between 8-20 characters in length";

         }
         
         if($usernameTaken->rowCount() > 0){
         	 $errors[] = "username has been taken";
         }

         if(!ctype_alnum($username)){
         	$errors[] = "Your username may only contain letters and numbers";
         }

         if(!ctype_alpha(substr($username,0,1))){
         	 $errors[] = "Username must start with a letter";
         }

         if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
          $errors[] = "That is not a valid email";

         }

         if($emailTaken->rowCount() > 0){

            $errors[] = "That email is already being used";
         }



   }

   





   if(!empty($errors)){

   	  return $errors;
   }else{

       $insert_reg_form = $conn->prepare("INSERT into users (username,password,email,activated) VALUES(:username,:password,:email,:activated)");
       $insert_reg_form->bindParam(":username",$username);
       $insert_reg_form->bindParam(":password",$password_hashed);
       $insert_reg_form->bindParam(":email",$email);
       $insert_reg_form->bindParam(":activated",$zero);
       $execute = $insert_reg_form->execute();

       if($execute == 1){

       	   $mail = new PHPMailer(true);

           $mail->isSMTP();
           $mail->Host = "mail.rosswilliamson.dev"; 
           $mail->SMTPAuth=true;
           $mail->Username="admin@rosswilliamson.dev";
           $mail->Password='ross2001';
           $mail->Port=465;
           $mail->SMPTSecure="ssl";
           $mail->SMTPDebug = 2;
           //end settings


           $mail->isHTML(true);
           $mail->setFrom("admin@rosswilliamson.dev",'Ross Williamson');
           $mail->FromName="Ross Williamson";
           $mail->addAddress($email, $username);
           $mail->Subject = "Activated your account";
           $mail->Body="
           <h2>please activated your account by clicking the link below </h2>
           <a href='https://rosswilliamson.dev/review/activate.php?verify=$activationLink'> Verify</a>
           ";

           if($mail->send()){

               $update = $conn->prepare("UPDATE users SET activation_link=:activation_link WHERE username=:username");

               $update->bindParam(":activation_link",$activationLink);
               $update->bindParam("username",$username);
               $update->execute();

               if($update->execute() == 1){

                   header('location:./');
                   $_SESSION['register_success'] = "Please check your email to verify your account";
               }
           }

       }
   }

}

?>

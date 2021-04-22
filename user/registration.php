<?php

include_once('modules/connect.php');


if(isset($_POST)){

           $username = mysqli_real_escape_string($db, $_POST["username"]);
		   		 $email = mysqli_real_escape_string($db, $_POST["email"]); 
           $password = mysqli_real_escape_string($db, $_POST["password"]);
           $password = md5($password);

		   $encryptionMethod = "AES-256-CBC";
		   $userid = openssl_encrypt($email, $encryptionMethod, $password,false,'asdlklhioquwye1a');

           $query = "INSERT INTO user (userid, username, password , email) VALUES('$userid', '$username', '$password', '$email')";
           mysqli_query($db, $query);

}
$db->close();
?>

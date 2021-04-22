<?php

include( 'modules/connect.php');

if ( !empty( $_POST )) {
$username = mysqli_real_escape_string($db, $_POST["username"]);
$password = mysqli_real_escape_string($db, $_POST["password"]);
}

$query = "SELECT * FROM admin WHERE username = '".$username."' AND password = '".$password."'";
if(!$result=$db->query($query)) {
    die($db->error);
}

if (isset($_SESSION['username']))
{
	echo "Έχεις κάνει ήδη login <b>".$_SESSION['username']."</b>! Μια φορά αρκεί.";
	header("location: home.php");

}

if(!$result->num_rows) {
    echo "Username: ".$username." or password : ".$password." does not exist";
}
else {
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id'];
        echo $_SESSION['username'];
}

$db->close();
?>

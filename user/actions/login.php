<?php

$db_host = '127.0.0.1';
$db_port = 3306;
$db_name = 'projectdb';
$db_username = 'pavlos';
$db_password = 'socker97';


$db = new mysqli($db_host, $db_username, $db_password, $db_name, $db_port);
if($db->connect_errno) {
    die( 'Could not connect to database '.$db->connect_error );
}
else {
    $db->set_charset( 'utf8' );
}

if ( !empty( $_POST )) {
$username = mysqli_real_escape_string($db, $_POST["username"]);
$password = mysqli_real_escape_string($db, $_POST["password"]);
$password = md5($password);
}

$query = "SELECT * FROM user WHERE username = '".$username."' AND password = '".$password."'";
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
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['password'] = $row['password'];
        echo $_SESSION['username'];
}

$db->close();
?>

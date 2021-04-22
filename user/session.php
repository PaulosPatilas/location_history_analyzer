<?php
session_start();
$user_check = $_SESSION['userid'];

include( 'modules/connect.php');

$query = "SELECT username,password FROM user WHERE userid = '".$user_check."'";

$ses_sql = mysqli_query($db,$query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['username'];
$password = $row['password'];
?>

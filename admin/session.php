<?php
session_start();
$user_check = $_SESSION['username'];

include( 'modules/connect.php');

$query = "SELECT username FROM admin WHERE username = '".$user_check."'";

$ses_sql = mysqli_query($db,$query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['username'];
?>

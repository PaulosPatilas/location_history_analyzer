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

//$query = "SELECT password FROM user  WHERE username = '".$_SESSION['username']."' ";
session_start();
$user_check = $_SESSION['userid'];


$query = "SELECT username,password FROM user WHERE userid = '".$user_check."'";

$ses_sql = mysqli_query($db,$query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['username'];
$password = $row['password'];

if(!isset($_POST['startdate']) && !isset($_POST['enddate'])){
  $startdate = '2016-09-01';
  $enddate = '2019-09-30';
}
else{
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];

$coordinates = "SELECT latitude, longitude FROM location WHERE user = '$password' AND loc_date BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime)";

if(!$result=$db->query($coordinates)) {
   die($db->error);
 }
foreach ($result = $db->query($coordinates)) {

    $row = $result->fetch_assoc();
    $longitude = $row['longitude'];
    $latitude = $row['latitude'];

    $singleDataset = array('lat' => $latitude, 'lon' => $longitude, 'count'=> 1);
    array_push($datasets,$singleDataset, JSON_FORCE_OBJECT);
    echo json_encode($datasets);
}


}



?>

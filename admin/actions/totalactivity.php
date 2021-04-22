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

$query1="SELECT COUNT(*) FROM activity WHERE type = 'IN_VEHICLE'";
$query2="SELECT COUNT(*) FROM activity WHERE type = 'ON_BICYCLE'";
$query3="SELECT COUNT(*) FROM activity WHERE type = 'ON_FOOT'";
$query4="SELECT COUNT(*) FROM activity WHERE type = 'RUNNING'";
$query5="SELECT COUNT(*) FROM activity WHERE type = 'STILL'";
$query6="SELECT COUNT(*) FROM activity WHERE type = 'TILTING'";
$query7="SELECT COUNT(*) FROM activity WHERE type = 'EXITING_VEHICLE'";
$query8="SELECT COUNT(*) FROM activity WHERE type = 'UNKNOWN'";
$query9="SELECT COUNT(*) FROM activity WHERE type = 'WALKING'";
$query10="SELECT COUNT(*) FROM activity WHERE type = 'IN_FOUR_WHEELER_VEHICLE'";
$query11="SELECT COUNT(*) FROM activity WHERE type = 'IN_TWO_WHEELER_VEHICLE'";
$query12="SELECT COUNT(*) FROM activity WHERE type = 'IN_BUS'";
$query13="SELECT COUNT(*) FROM activity WHERE type = 'IN_CAR'";
$query14="SELECT COUNT(*) FROM activity WHERE type = 'IN_ROAD_VEHICLE'";

if(!$result=$db->query($query1)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$vehicle = $row['COUNT(*)'];

if(!$result=$db->query($query2)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$bicucle = $row['COUNT(*)'];
if(!$result=$db->query($query3)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$foot = $row['COUNT(*)'];
if(!$result=$db->query($query4)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$run = $row['COUNT(*)'];
if(!$result=$db->query($query5)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$still = $row['COUNT(*)'];
if(!$result=$db->query($query6)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$tilt = $row['COUNT(*)'];
if(!$result=$db->query($query7)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$exiting = $row['COUNT(*)'];
if(!$result=$db->query($query8)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$unknown = $row['COUNT(*)'];
if(!$result=$db->query($query9)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$walk = $row['COUNT(*)'];
if(!$result=$db->query($query10)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$fourwheel = $row['COUNT(*)'];
if(!$result=$db->query($query11)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$twowheel = $row['COUNT(*)'];
if(!$result=$db->query($query12)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$bus = $row['COUNT(*)'];
if(!$result=$db->query($query13)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$car = $row['COUNT(*)'];
if(!$result=$db->query($query14)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$roadvehicle = $row['COUNT(*)'];

$totaldata = array($vehicle,$bicucle,$foot,$run,$still,$tilt,$exiting,$unknown,$walk,$fourwheel,$twowheel,$bus,$car,$roadvehicle);

echo json_encode($totaldata);
?>

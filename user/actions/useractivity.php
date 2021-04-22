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


// if(!$result=$db->query($query)) {
//     die($db->error);
// }
//
//         $row = $result->fetch_assoc();
// 				$password = $row['password'];
 if(!isset($_POST['startdate']) && !isset($_POST['enddate'])){
   $startdate = '2016-09-01';
   $enddate = '2019-09-30';
}
else{
  $startdate = $_POST['startdate'];
  $enddate = $_POST['enddate'];
  //$GLOBALS['dataPoints'] = array( );

$query1 = "SELECT COUNT(loc_id) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_VEHICLE'  ";
$query2 = "SELECT COUNT(loc_id) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'ON_BICYCLE'  ";
$query3 = "SELECT COUNT(loc_id) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'ON_FOOT'  ";
$query4 = "SELECT COUNT(loc_id) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'RUNNING'  ";
$query5 = "SELECT COUNT(loc_id) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'STILL'  ";
$query6 = "SELECT COUNT(loc_id) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'TILTING'  ";
$query7 = "SELECT COUNT(loc_id) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'EXITING_VEHICLE'  ";
$query8 = "SELECT COUNT(loc_id) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'UNKNOWN'  ";
$query9 = "SELECT COUNT(loc_id) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'WALKING'  ";
$query10 = "SELECT COUNT(loc_id) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_FOUR_WHEELER_VEHICLE'  ";
$query11 = "SELECT COUNT(loc_id) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_TWO_WHEELER_VEHICLE' ";
$query12 = "SELECT COUNT(loc_id) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_BUS'  ";
$query13 = "SELECT COUNT(loc_id) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_CAR'  ";
$query14 = "SELECT COUNT(loc_id) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_ROAD_VEHICLE'  ";
$maxhour1 =  "SELECT hour,maxcount FROM (SELECT HOUR(timestampMs) AS hour, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_VEHICLE' GROUP BY HOUR(timestampMs)) AS maxHour WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_VEHICLE' GROUP BY HOUR(timestampMs))";
$maxhour2 ="SELECT hour,maxcount FROM (SELECT HOUR(timestampMs) AS hour, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'ON_BICYCLE' GROUP BY HOUR(timestampMs)) AS maxHour WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'ON_BICYCLE' GROUP BY HOUR(timestampMs))";
$maxhour3 ="SELECT hour,maxcount FROM (SELECT HOUR(timestampMs) AS hour, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'ON_FOOT' GROUP BY HOUR(timestampMs)) AS maxHour WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'ON_FOOT' GROUP BY HOUR(timestampMs))";
$maxhour4 ="SELECT hour,maxcount FROM (SELECT HOUR(timestampMs) AS hour, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'RUNNING' GROUP BY HOUR(timestampMs)) AS maxHour WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'RUNNING' GROUP BY HOUR(timestampMs))";
$maxhour5 ="SELECT hour,maxcount FROM (SELECT HOUR(timestampMs) AS hour, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'STILL' GROUP BY HOUR(timestampMs)) AS maxHour WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'STILL' GROUP BY HOUR(timestampMs))";
$maxhour6 ="SELECT hour,maxcount FROM (SELECT HOUR(timestampMs) AS hour, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'TILTING' GROUP BY HOUR(timestampMs)) AS maxHour WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'TILTING' GROUP BY HOUR(timestampMs))";
$maxhour7 ="SELECT hour,maxcount FROM (SELECT HOUR(timestampMs) AS hour, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'EXITING_VEHICLE' GROUP BY HOUR(timestampMs)) AS maxHour WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'EXITING_VEHICLE' GROUP BY HOUR(timestampMs))";
$maxhour8 ="SELECT hour,maxcount FROM (SELECT HOUR(timestampMs) AS hour, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'UNKNOWN' GROUP BY HOUR(timestampMs)) AS maxHour WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'UNKNOWN' GROUP BY HOUR(timestampMs))";
$maxhour9 ="SELECT hour,maxcount FROM (SELECT HOUR(timestampMs) AS hour, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'WALKING' GROUP BY HOUR(timestampMs)) AS maxHour WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'WALKING' GROUP BY HOUR(timestampMs))";
$maxhour10 ="SELECT hour,maxcount FROM (SELECT HOUR(timestampMs) AS hour, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_FOUR_WHEELER_VEHICLE' GROUP BY HOUR(timestampMs)) AS maxHour WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_FOUR_WHEELER_VEHICLE' GROUP BY HOUR(timestampMs))";
$maxhour11 ="SELECT hour,maxcount FROM (SELECT HOUR(timestampMs) AS hour, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_TWO_WHEELER_VEHICLE' GROUP BY HOUR(timestampMs)) AS maxHour WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_ΤWΟ_WHEELER_VEHICLE' GROUP BY HOUR(timestampMs))";
$maxhour12 ="SELECT hour,maxcount FROM (SELECT HOUR(timestampMs) AS hour, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_BUS' GROUP BY HOUR(timestampMs)) AS maxHour WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_BUS' GROUP BY HOUR(timestampMs))";
$maxhour13 ="SELECT hour,maxcount FROM (SELECT HOUR(timestampMs) AS hour, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_CAR' GROUP BY HOUR(timestampMs)) AS maxHour WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_CAR' GROUP BY HOUR(timestampMs))";
$maxhour14 ="SELECT hour,maxcount FROM (SELECT HOUR(timestampMs) AS hour, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_ROAD_VEHICLE' GROUP BY HOUR(timestampMs)) AS maxHour WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_ROAD_VEHICLE' GROUP BY HOUR(timestampMs))";
$maxday1 = "SELECT day,maxcount FROM (SELECT DAY(timestampMs) AS day, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_VEHICLE' GROUP BY DAY(timestampMs)) AS maxDAY WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_VEHICLE' GROUP BY DAY(timestampMs))";
$maxday2 = "SELECT day,maxcount FROM (SELECT DAY(timestampMs) AS day, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'ON_BICYCLE' GROUP BY DAY(timestampMs)) AS maxDAY WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'ON_BICYCLE' GROUP BY DAY(timestampMs))";
$maxday3 = "SELECT day,maxcount FROM (SELECT DAY(timestampMs) AS day, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'ON_FOOT' GROUP BY DAY(timestampMs)) AS maxDAY WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'ON_FOOT' GROUP BY DAY(timestampMs))";
$maxday4 = "SELECT day,maxcount FROM (SELECT DAY(timestampMs) AS day, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'RUNNING' GROUP BY DAY(timestampMs)) AS maxDAY WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'RUNNING' GROUP BY DAY(timestampMs))";
$maxday5 = "SELECT day,maxcount FROM (SELECT DAY(timestampMs) AS day, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'STILL' GROUP BY DAY(timestampMs)) AS maxDAY WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'STILL' GROUP BY DAY(timestampMs))";
$maxday6 = "SELECT day,maxcount FROM (SELECT DAY(timestampMs) AS day, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'TILTING' GROUP BY DAY(timestampMs)) AS maxDAY WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'TILTING' GROUP BY DAY(timestampMs))";
$maxday7 = "SELECT day,maxcount FROM (SELECT DAY(timestampMs) AS day, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'EXITING_VEHICLE' GROUP BY DAY(timestampMs)) AS maxDAY WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'EXITING_VEHICLE' GROUP BY DAY(timestampMs))";
$maxday8 = "SELECT day,maxcount FROM (SELECT DAY(timestampMs) AS day, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'UNKNOWN' GROUP BY DAY(timestampMs)) AS maxDAY WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'UNKNOWN' GROUP BY DAY(timestampMs))";
$maxday9 = "SELECT day,maxcount FROM (SELECT DAY(timestampMs) AS day, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'WALKING' GROUP BY DAY(timestampMs)) AS maxDAY WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'WALKING' GROUP BY DAY(timestampMs))";
$maxday10 = "SELECT day,maxcount FROM (SELECT DAY(timestampMs) AS day, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_FOUR_WHEELER_VEHICLE' GROUP BY DAY(timestampMs)) AS maxDAY WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_FOUR_WHEELER_VEHICLE' GROUP BY DAY(timestampMs))";
$maxday11 = "SELECT day,maxcount FROM (SELECT DAY(timestampMs) AS day, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_TWO_WHEELER_VEHICLE' GROUP BY DAY(timestampMs)) AS maxDAY WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_ΤWΟ_WHEELER_VEHICLE' GROUP BY DAY(timestampMs))";
$maxday12 = "SELECT day,maxcount FROM (SELECT DAY(timestampMs) AS day, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_BUS' GROUP BY DAY(timestampMs)) AS maxDAY WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_BUS' GROUP BY DAY(timestampMs))";
$maxday13 = "SELECT day,maxcount FROM (SELECT DAY(timestampMs) AS day, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_CAR' GROUP BY DAY(timestampMs)) AS maxDAY WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_CAR' GROUP BY DAY(timestampMs))";
$maxday14 = "SELECT day,maxcount FROM (SELECT DAY(timestampMs) AS day, Count(*) AS maxcount FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_ROAD_VEHICLE' GROUP BY DAY(timestampMs)) AS maxDAY WHERE maxcount >=ALL(SELECT Count(*) FROM activity WHERE USER = '$password' AND timestampMs BETWEEN Cast('$startdate' as datetime) AND Cast('$enddate' as datetime) AND type = 'IN_ROAD_VEHICLE' GROUP BY DAY(timestampMs))";
if(!$result=$db->query($query1)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$vehicle = $row['COUNT(loc_id)'];


if(!$result=$db->query($query2)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$ON_BICYCLE = $row['COUNT(loc_id)'];

if(!$result=$db->query($query3)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$ON_FOOT = $row['COUNT(loc_id)'];


if(!$result=$db->query($query4)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$RUNNING = $row['COUNT(loc_id)'];


if(!$result=$db->query($query5)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$STILL = $row['COUNT(loc_id)'];


if(!$result=$db->query($query6)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$TILTING = $row['COUNT(loc_id)'];


if(!$result=$db->query($query7)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$EXITING_VEHICLE = $row['COUNT(loc_id)'];


if(!$result=$db->query($query8)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$UNKNOWN = $row['COUNT(loc_id)'];


if(!$result=$db->query($query9)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$WALKING = $row['COUNT(loc_id)'];


if(!$result=$db->query($query10)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$IN_FOUR_WHEELER_VEHICLE = $row['COUNT(loc_id)'];


if(!$result=$db->query($query11)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$IN_TWO_WHEELER_VEHICLE = $row['COUNT(loc_id)'];


if(!$result=$db->query($query12)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$IN_BUS = $row['COUNT(loc_id)'];


if(!$result=$db->query($query13)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$IN_CAR = $row['COUNT(loc_id)'];


if(!$result=$db->query($query14)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$IN_ROAD_VEHICLE = $row['COUNT(loc_id)'];

if(!$result=$db->query($maxhour1)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$HOUR_IN_VEHICLE = $row['hour'];

if(!$result=$db->query($maxhour2)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$HOUR_ON_BICYCLE = $row['hour'];

if(!$result=$db->query($maxhour3)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$HOUR_ON_FOOT = $row['hour'];

if(!$result=$db->query($maxhour4)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$HOUR_RUNNING = $row['hour'];

if(!$result=$db->query($maxhour5)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$HOUR_STILL = $row['hour'];

if(!$result=$db->query($maxhour6)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$HOUR_TILTING = $row['hour'];

if(!$result=$db->query($maxhour7)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$HOUR_EXITING_VEHICLE = $row['hour'];

if(!$result=$db->query($maxhour8)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$HOUR_UNKNOWN = $row['hour'];

if(!$result=$db->query($maxhour9)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$HOUR_WALKING = $row['hour'];

if(!$result=$db->query($maxhour10)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$HOUR_IN_FOUR_WHEELER_VEHICLE = $row['hour'];

if(!$result=$db->query($maxhour11)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$HOUR_IN_TWO_WHEELER_VEHICLE = $row['hour'];

if(!$result=$db->query($maxhour12)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$HOUR_IN_BUS = $row['hour'];

if(!$result=$db->query($maxhour13)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$HOUR_IN_CAR = $row['hour'];

if(!$result=$db->query($maxhour14)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$HOUR_IN_ROAD_VEHICLE = $row['hour'];

if(!$result=$db->query($maxday1)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$DAY_IN_VEHICLE = $row['day'];

if(!$result=$db->query($maxday2)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$DAY_ON_BICYCLE = $row['day'];

if(!$result=$db->query($maxday3)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$DAY_ON_FOOT = $row['day'];

if(!$result=$db->query($maxday4)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$DAY_RUNNING = $row['day'];

if(!$result=$db->query($maxday5)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$DAY_STILL = $row['day'];

if(!$result=$db->query($maxday6)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$DAY_TILTING = $row['day'];

if(!$result=$db->query($maxday7)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$DAY_EXITING_VEHICLE = $row['day'];

if(!$result=$db->query($maxday8)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$DAY_UNKNOWN = $row['day'];

if(!$result=$db->query($maxday9)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$DAY_WALKING = $row['day'];

if(!$result=$db->query($maxday10)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$DAY_IN_FOUR_WHEELER_VEHICLE = $row['day'];

if(!$result=$db->query($maxday11)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$DAY_IN_TWO_WHEELER_VEHICLE = $row['day'];

if(!$result=$db->query($maxday12)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$DAY_IN_BUS = $row['day'];

if(!$result=$db->query($maxday13)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$DAY_IN_CAR = $row['day'];

if(!$result=$db->query($maxday14)) {
   die($db->error);
 }
$row = $result->fetch_assoc();
$DAY_IN_ROAD_VEHICLE = $row['day'];

				$dataPoints = array($vehicle,$ON_BICYCLE,$ON_FOOT,$RUNNING,$STILL,$TILTING,$UNKNOWN,$WALKING,$EXITING_VEHICLE,$IN_ROAD_VEHICLE,$IN_FOUR_WHEELER_VEHICLE,$IN_TWO_WHEELER_VEHICLE,$IN_BUS,$IN_CAR,$HOUR_IN_VEHICLE,$HOUR_ON_BICYCLE,$HOUR_ON_FOOT,$HOUR_RUNNING,$HOUR_STILL,$HOUR_TILTING,$HOUR_UNKNOWN,$HOUR_WALKING,$HOUR_EXITING_VEHICLE,$HOUR_IN_FOUR_WHEELER_VEHICLE,$HOUR_IN_TWO_WHEELER_VEHICLE,$HOUR_IN_BUS,$HOUR_IN_CAR,$HOUR_IN_ROAD_VEHICLE,$DAY_IN_VEHICLE,$DAY_ON_BICYCLE,$DAY_ON_FOOT,$DAY_RUNNING,$DAY_STILL,$DAY_TILTING,$DAY_UNKNOWN,$DAY_WALKING,$DAY_EXITING_VEHICLE,$DAY_IN_ROAD_VEHICLE,$DAY_IN_FOUR_WHEELER_VEHICLE,$DAY_IN_TWO_WHEELER_VEHICLE,$DAY_IN_BUS,$DAY_IN_CAR);
        echo json_encode($dataPoints);
        //print_r($dataPoints);
$db ->close();
}

?>

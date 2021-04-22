<?php
include('modules/connect.php');

$pass = $_SESSION['password'];
$default = 60;

$query="SELECT latest_upload FROM user WHERE password = '$pass'";

 if(!$result=$db->query($query)) {
		 die($db->error);
 }
 $row = $result->fetch_assoc();
 $latestupload = $row['latest_upload'];

$mindate="SELECT MIN(loc_date) FROM location WHERE user = '$pass'";
$maxdate="SELECT MAX(loc_date) FROM location WHERE  user = '$pass'";
if(!$result=$db->query($mindate)) {
		die($db->error);
}
$row = $result->fetch_assoc();
$minimumdate = $row['MIN(loc_date)'];

if(!$result=$db->query($maxdate)) {
	 die($db->error);
}
$row = $result->fetch_assoc();
$maximumdate = $row['MAX(loc_date)'];

$score = "SELECT COUNT(loc_id) FROM activity  WHERE MONTH(timestampMs) = MONTH(CURRENT_DATE) AND YEAR(timestampMs) = YEAR(CURRENT_DATE) AND user = '$pass' AND ( type = 'STILL' OR type = 'ON_FOOT' OR type = 'ON_BICYCLE' OR type = 'RUNNING' OR type = 'TILTING' OR type = 'WALKING') ";
if(!$result=$db->query($score)) {
	 die($db->error);
}
$row = $result->fetch_assoc();
$sc = $row['COUNT(loc_id)'];

$total = "SELECT COUNT(loc_id) FROM activity  WHERE user = '$pass' AND MONTH(timestampMs) = MONTH(CURRENT_DATE) AND YEAR(timestampMs) = YEAR(CURRENT_DATE)";

if(!$result=$db->query($total)) {
	 die($db->error);
}
$row = $result->fetch_assoc();
$scTotal = $row['COUNT(loc_id)'];

$last12months = "SELECT COUNT(loc_id) FROM activity WHERE user = '$pass' AND timestampMs >= DATE_SUB(CURRENT_DATE,INTERVAL 12 MONTH) AND ( type = 'STILL' OR type = 'ON_FOOT' OR type = 'ON_BICYCLE' OR type = 'RUNNING' OR type = 'TILTING' OR type = 'WALKING')";
if(!$result=$db->query($total)) {
	 die($db->error);
}
$row = $result->fetch_assoc();
$score12= $row['COUNT(loc_id)'];

$lasttotal12months = "SELECT COUNT(loc_id) FROM activity WHERE user = '$pass' AND timestampMs >= DATE_SUB(CURRENT_DATE,INTERVAL 12 MONTH)";
if(!$result=$db->query($total)) {
	 die($db->error);
}
$row = $result->fetch_assoc();
$totalscore12= $row['COUNT(loc_id)'];

if($scTotal != 0 && $totalscore12 !=0){
$score = $sc/$scTotal; // mhniaio score
$score12 = $score12/$totalscore12;// ethsio score
}
else {
  $score = $sc;
  $score12 = $score12;
}
//EDW PREPEI NA MPEI TO BACK_END GIA TO LEADERBOARD
$db->close();

?>

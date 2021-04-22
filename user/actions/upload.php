<?php

session_start();

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

if( isset( $_POST['import'] )) {
    $target = "uploads/";
    $target = $target . basename( $_FILES['jsonfile']['name']) ;
    // if(move_uploaded_file($_FILES['jsonfile']['tmp_name'], $target))
    // {
    //     echo "The file ". basename( $_FILES['jsonfile']['name']). " has been uploaded";
    // }
    // else {
    //     echo "Sorry, there was a problem uploading your file.";
    // }

    $locations = file_get_contents('uploads/'.$_FILES['jsonfile']['name']);
    $location_array = json_decode($locations);
    $password = $_SESSION['password'];
    $latfilter= 38.230462;
    $longfilter = 21.753150;
    $IN_VEHICLE = 0 ;
    $ON_BICYCLE= 0 ;
    $ON_FOOT= 0 ;
    $RUNNING= 0 ;
    $STILL= 0 ;
    $TILTING= 0 ;
    $UNKNOWN= 0 ;
    $WALKING= 0 ;
    $EXITING_VEHICLE= 0 ;
    $IN_ROAD_VEHICLE= 0 ;
    $IN_FOUR_WHEELER_VEHICLE= 0 ;
    $IN_TWO_WHEELER_VEHICLE= 0 ;
    $IN_BUS= 0 ;
    $IN_CAR= 0 ;
    $IN_TOTAL= 0 ;

    foreach ($location_array->locations as $mylocation) {

        $timestampMs = $mylocation->timestampMs ;
        $latitude = $mylocation->latitudeE7/10000000 ;
        $longtitude = $mylocation->longitudeE7/10000000 ;
        $accuracy = $mylocation->accuracy  ;

        $timestampSeconds =   $timestampMs / 1000;
        //echo $latitude .$longtitude ;

      $date = date(" Y-m-d H:i:s", $timestampSeconds);

    $km = haversineGreatCircleDistance($latitude,$longtitude,$latfilter,$longfilter);
    if($km <= 10){
      $query = "INSERT INTO location (latitude, longitude, accuracy, loc_date , user ) VALUES('$latitude', '$longtitude','$accuracy','$date','$password')";
      $selectId = "SELECT id FROM location WHERE loc_date = '$date'";
      if(!mysqli_query($db, $query)){

        die('Error : ' . $db->error);
      }
      if(!$result=$db->query($selectId)) {
          die($db->error);
      }
      $row = $result->fetch_assoc();
      $id = $row['id'];


            foreach ($mylocation->activity as $act) {

              $activity_timestamp = $act->timestampMs ;
              $activity_seconds =$activity_timestamp/1000;
              $activity_datetime = date(" Y-m-d H:i:s", $activity_seconds);

              $maxConf = 0;
                foreach ($act->activity as $type) {

                  if($type->confidence > $maxConf){
                      $maxConf = $type->confidence;
                      $actType = $type->type;
                  }

                }
                if($actType == 'IN_VEHICLE'){
                  $IN_VEHICLE++;
                }
                else if($actType == 'ON_BICYCLE'){
                  $ON_BICYCLE++;
                }
                else  if($actType == 'ON_FOOT'){
                  $ON_FOOT++;
                }
                else  if($actType == 'RUNNING'){
                  $RUNNING++;
                }
                else  if($actType == 'STILL'){
                  $STILL++;
                }
                else  if($actType == 'TILTING'){
                  $TILTING++;
                }
                else  if($actType == 'UNKNOWN'){
                  $UNKNOWN++;
                }
                else  if($actType == 'WALKING'){
                  $WALKING++;
                }
                else  if($actType == 'EXITING_VEHICLE'){
                  $EXITING_VEHICLE++;
                }
                else  if($actType == 'IN_ROAD_VEHICLE'){
                  $IN_ROAD_VEHICLE++;
                }
                else  if($actType == 'IN_FOUR_WHEELER_VEHICLE'){
                  $IN_FOUR_WHEELER_VEHICLE++;
                }
                else  if($actType == 'IN_TWO_WHEELER_VEHICLE'){
                  $IN_TWO_WHEELER_VEHICLE++;
                }
                else  if($actType == 'IN_CAR'){
                  $IN_CAR++;
                }
                else  if($actType == 'IN_BUS'){
                  $IN_BUS++;
                }
                $insertAct = "INSERT INTO activity (timestampMs, type, confidence, loc_id , user) VALUES('$activity_datetime', '$actType',  '$maxConf','$id' , '$password')";
                $IN_TOTAL++;
                if(!mysqli_query($db, $insertAct)){

                  die('Error : ' . $db->error);
                }

            }

}

    }
    $inserttype = "INSERT INTO totaluseractivity (IN_VEHICLE, ON_BICYCLE, ON_FOOT, RUNNING,STILL,TILTING,UNKNOWN,WALKING,EXITING_VEHICLE,IN_ROAD_VEHICLE,IN_FOUR_WHEELER_VEHICLE,IN_TWO_WHEELER_VEHICLE,IN_BUS,IN_CAR,Total,USER) VALUES('$IN_VEHICLE', '$ON_BICYCLE', '$ON_FOOT','$RUNNING','$STILL','$TILTING','$UNKNOWN','$WALKING','$EXITING_VEHICLE','$IN_ROAD_VEHICLE','$IN_FOUR_WHEELER_VEHICLE','$IN_TWO_WHEELER_VEHICLE','$IN_BUS','$IN_CAR','$IN_TOTAL','$password')";

    if(!mysqli_query($db, $inserttype)){

      die('Error : ' . $db->error);
    }

    $upload = "UPDATE user SET latest_upload = now() WHERE password = '$password' ";
    if(!mysqli_query($db, $upload)){

      die('Error : ' . $db->error);
    }
$db->close();
header('location: insertdata.php');
}

function haversineGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  return $angle * $earthRadius;
}
 ?>

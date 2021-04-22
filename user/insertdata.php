<?php
include('session.php');

if(!isset($_SESSION['username'])){
	header("location: login.html");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title> Home Page </title>
	<!-- <link rel = "stylesheet" type = "text/css" href="css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
	<link rel="stylesheet" href="js/leaflet.draw/src/leaflet.draw.css"/>
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
	<script  src = 'js/leaflet.draw/src/Leaflet.draw.js'></script>
	<script src = 'js/leaflet.draw/src/Leaflet.Draw.Event.js'></script>

	<script  src = 'js/leaflet.draw/src/edit/handler/Edit.Poly.js'></script>
	<script  src = 'js/leaflet.draw/src/edit/handler/Edit.SimpleShape.js'></script>
	<script  src = 'js/leaflet.draw/src/edit/handler/Edit.Marker.js'></script>
	<script  src = 'js/leaflet.draw/src/edit/handler/Edit.CircleMarker.js'></script>
	<script  src = 'js/leaflet.draw/src/edit/handler/Edit.Circle.js'></script>
 <!--<script  src = 'js/leaflet.draw/src/edit/handler/Edit.Rectangle.js"'></script>-->

	<script  src = 'js/leaflet.draw/src/draw/handler/Draw.Feature.js'></script>
	<script  src = 'js/leaflet.draw/src/draw/handler/Draw.SimpleShape.js'></script>
	<script  src = 'js/leaflet.draw/src/draw/handler/Draw.Polyline.js'></script>
	<script  src = 'js/leaflet.draw/src/draw/handler/Draw.Marker.js'></script>
	<script  src = 'js/leaflet.draw/src/draw/handler/Draw.Circle.js'></script>
	<script  src = 'js/leaflet.draw/src/draw/handler/Draw.CircleMarker.js'></script>
	<script  src = 'js/leaflet.draw/src/draw/handler/Draw.Polygon.js'></script>
	<script  src = 'js/leaflet.draw/src/draw/handler/Draw.Rectangle.js'></script>

	<script  src = 'js/leaflet.draw/src/ext/GeometryUtil.js'></script>
	<script  src = 'js/leaflet.draw/src/ext/LatLngUtil.js'></script>
	<script  src = 'js/leaflet.draw/src/ext/LineUtil.Intersect.js'></script>
	<script  src = 'js/leaflet.draw/src/ext/Polygon.Intersect.js'></script>
	<script  src = 'js/leaflet.draw/src/ext/Polyline.Intersect.js'></script>
	<script  src = 'js/leaflet.draw/src/ext/TouchEvents.js'></script>


	<script  src = 'js/leaflet.draw/src/Control.Draw.js'></script>
	<script  src = 'js/leaflet.draw/src/Toolbar.js'></script>
	<script  src = 'js/leaflet.draw/src/Tooltip.js'></script>

	<script  src = 'js/leaflet.draw/src/draw/DrawToolbar.js'></script>
	<script  src = 'js/leaflet.draw/src/edit/EditToolbar.js'></script>
	<script  src = 'js/leaflet.draw/src/edit/handler/EditToolbar.Edit.js'></script>
	<script  src = 'js/leaflet.draw/src/edit/handler/EditToolbar.Delete.js'></script>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


</head>

	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: steelblue  ; border-bottom-width: 2px;  border-bottom-color: steelblue; ">
	        <div class="container-fluid">
	            <div class="navbar-header">

	                <h4 style="color:black;"><small style="color:white; margin-left: 10px;">Version 1.2.0</small></h4>
	            </div>
	            <div class="navbar-collapse collapse" style="background-color:steelblue;text-align:start;">
	                <ul class="nav navbar-nav navbar-right" style="background-color: steelblue;">

	                    <li><a onclick="goBack()" style="color: gray; background-color: white; cursor: pointer; font-weight: bold; border: 1px solid; border-radius:5px; border-color: gray; text-align:center; padding-left : inherit"><span><img src="~/Content/styles/images/wp8_inverseicons.png" style=" width:20%; padding-right: 5px; " /></span>Πίσω</a></li>

											<li><a href="logout.php" style="color: white; background-color: red; font-weight: bold; border: 1px solid; border-radius: 5px; border-color: red; width:150px;  "> <span><img src="images/logout.jpg" style=" width:25%; padding-right:5px;" /></span>Αποσύνδεση</a></li>
	                </ul>
	                <form class="navbar-form navbar-right" style="background-color: steelblue;">
	                </form>
	            </div>
	        </div>
	    </div>
			<div class="container-fluid" style="font-size:12px;">
                <div class="row">
                    <div class="col-sm-3 col-md-2 sidebar" style="position:fixed; width: 150px; height:100%; background-color: steelblue; border-right-color:steelblue; min-width:100px; ">
                        <ul class="nav nav-sidebar" style="font-weight: bold; margin-top: 70px;">
                            <li id="hover"><a style="color: white; font-family : Times New Romans; font-size : 16px" href="home.php">Αρχική</a></li>
                            <li id ="hover"><a style="color: white; font-family : Times New Romans; font-size : 16px" href="data.php">Απεικόνιση στοιχείων</a></li>
                            <li id="manage" ><a style="color: white; font-family : Times New Romans; font-size : 16px " href="insertdata.php">Εισαγωγή Δεδομένων</a></li>
                            <li id="manage"><a style="color: white; font-family : Times New Romans; font-size : 16px" href="">Leaderboard</a></li>
                            <li id="pdf"><a style="color: white; font-family : Times New Romans; font-size : 16px" href="logout.php">ΑΠΟΣΥΝΔΕΣΗ</a></li>
                        </ul>
                    </div>

                </div>
            </div>
						<div id="mapid"></div>

<div>
						<form action="actions/upload.php" enctype="multipart/form-data" method = "post" style="padding-left:1000px; padding-top: 200px ; ">
						  <input type="file" value='Upload' id='upload' name="jsonfile">
						  <input type="submit" name='import' value='Import' id='import'>
						</form>
</div>

		<script>
		var drawPolygonButton = document.getElementById('drawPolygon');
		var stopDrawButton = document.getElementById('stopDraw');
		var getDataButton = document.getElementById('getData');
		//var currentPolygon = {}; //Empty object to be used later;
		var map = L.map('mapid').setView([38.2462420, 21.7350847], 16);
		L.tileLayer(
  'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Data © <a href="http://osm.org/copyright">OpenStreetMap</a>',
    maxZoom: 18
  }).addTo(map);


var editableLayers = new L.FeatureGroup();
map.addLayer(editableLayers);

var drawPluginOptions = {
  position: 'topright',
  draw: {
    polygon: {
      allowIntersection: false, // Restricts shapes to simple polygons
      drawError: {
        color: '#e1e100', // Color the shape will turn when intersects
        message: '<strong>Oh snap!<strong> you can\'t draw that!' // Message that will show when intersect
      },
      shapeOptions: {
        color: '#97009c'
      }
    },
    // disable toolbar item by setting it to false
    polyline: false,
    circle: true, // Turns off this drawing tool
    rectangle: true,
    marker: true,
  },
  edit: {
    featureGroup: editableLayers, //REQUIRED!!
    remove: true
  }
};

// Initialise the draw control and pass it the FeatureGroup of editable layers
var drawControl = new L.Control.Draw(drawPluginOptions);
map.addControl(drawControl);



map.on('draw:created', function(e) {
  var type = e.layerType,
    layer = e.layer;

  if (type === 'marker') {
    layer.bindPopup('A popup!');
  }

  editableLayers.addLayer(layer);
});


		//var circle = new L.circle([38.2462420, 21.7350847], {
    	//color: 'red',
    	//fillColor: '#f03',
    	//fillOpacity: 0.5,
    	//radius: 500
		//}).addTo(mymap);


		//drawPolygonButton.addEventListener('click', function(){
    	//currentPolygon = L.polygon([]).addTo(mymap);
      //mymap.on('click', addLatLngToPolygon); //Listen for clicks on map.
	  //});

		//stopDraw.addEventListener('click', function(){
			//currentPolygon.addTo(mymap);
    //mymap.off('click', addLatLngToPolygon); //Stop listening for clicks on map.
	//});

		//getDataButton.addEventListener('click', function(){
        //var data = currentPolygon.getLatLngs();
        //console.log(data);
        //SEND DATA USING AJAX
    //});

		//function addLatLngToPolygon(clickEventData){
      //currentPolygon.addLatLng(clickEventData.latlng);
			//console.log(clickEventData.latlng);
 //}

//function simplifyLatLngs(latlngs){
    //var x = []; //blank array
    //for(var i=0;i<latlngs.length;i++){
            //x.push([latlngs[i].lat,latlngs[i].lng]);
    //}
    //return x;
//}
		//mymap.on('click', onMapClick);
		//mymap.on('click', onPolyClick);

		//Add polygon to map
		//mymap.addTo(mymap);

//function onMapClick(e) {
//    alert("You clicked the map at " + e.latlng);
//		editing++;
//}
		</script>
		<style>
#manage :hover {
		background-color:cadetblue;
}

#hover :hover {
		background-color:cadetblue;
}

#pdf :hover {
		background-color : cadetblue;
}
#mapid { height: 400px;
				margin-top: 80px;
				margin-left: 200px;
				margin-right: 700px;
 }
#drawPolygon{
	  margin-top: 10px;
		margin-left: 200px;
}
#stopDraw{
		margin-top: 10px;
		margin-left: 200px;
}
#getData{
	  margin-top: 10px;
		margin-left: 200px;
}
</style>
	</body>
</html>

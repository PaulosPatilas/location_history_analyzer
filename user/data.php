<?php
include('actions/useractivity.php');

if(!isset($_SESSION['username'])){
	header("location: login.html");
	echo $password;
}

include('actions/script.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title> Home Page </title>


	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"/>
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/heatmapjs@2.0.2/heatmap.js"> </script>
<script type="application/json" src="js\heatmap.js-master\plugins\leaflet-heatmap.js"></script>
	<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

	<body>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: steelblue; border-bottom-width: 2px;  border-bottom-color: steelblue; ">
	        <div class="container-fluid">
	            <div class="navbar-header">
	                <h4 style="color:black;"><small style="color:white; margin-left: 10px;">Version 1.2.0</small></h4>
	            </div>
	            <div class="navbar-collapse collapse" style="background-color:steelblue;text-align:start;">
	                <!-- <ul class="navbar-nav navbar-left" style="background-color: steelblue;">

	                    <li><a onclick="goBack()" style="color: gray; background-color: white; cursor: pointer; font-weight: bold; border: 1px solid; border-radius:5px; border-color: gray; text-align:center; padding-left : inherit"><span><img src="~/Content/styles/images/wp8_inverseicons.png" style=" width:20%; padding-right: 5px; " /></span>Πίσω</a></li>

											<li><a href="logout.php" style="color: white; background-color: red; font-weight: bold; border: 1px solid; border-radius: 5px; border-color: red; width:150px;  "> <span><img src="images/logout.jpg" style=" width:25%; padding-right:5px;" /></span>Αποσύνδεση</a></li>
	                </ul> -->
	                <!-- <form class="navbar-form navbar-right" style="background-color: steelblue;">
	                </form> -->
	            </div>
	        </div>
	    </div>
			<div class="container-fluid" style="font-size:12px;">
                <div class="row">
                    <div class="col-sm-3 col-md-2 sidebar" style="position:fixed; width: 150px; height:100%; background-color: steelblue; border-right-color:steelblue; min-width:100px; ">
                        <ul class="nav nav-sidebar" style="font-weight: bold; margin-top: 40px;">
                            <li id="hover"><a style="color: white; font-family : Times New Romans; font-size : 16px" href="home.php">Αρχική</a></li>
                            <li id ="hover"><a style="color: white; font-family : Times New Romans; font-size : 16px" href="data.php">Απεικόνιση στοιχείων</a></li>
                            <li id="manage"><a style="color: white; font-family : Times New Romans; font-size : 16px " href="insertdata.php">Εισαγωγή Δεδομένων</a></li>
                            <li id="manage"><a style="color: white; font-family : Times New Romans; font-size : 16px" href="">Leaderboards</a></li>
                            <li id="lougout"><a style="color: white; font-family : Times New Romans; font-size : 16px" href="logout.php">ΑΠΟΣΥΝΔΕΣΗ</a></li>
                        </ul>
                    </div>

                </div>
            </div>

	<div class="dates">
	  <div class="start_date input-group mb-3" >
	    <input class="form-control start_date" type="text" placeholder="start date" id="startdate_datepicker">
	  </div>
	  <div class="end_date input-group mb-3">
	    <input class="form-control end_date" type="text" placeholder="end date" id="enddate_datepicker">
	  </div>
		<button type="button" id='btn' style="margin-left: 200px;" class="btn btn-primary">Get Results</button>
		<button type="button" id='chart' style="margin-left: 200px;" class="btn btn-primary">Get Chart</button>
	</div>


						<!-- <input id="datepicker" width="500" /> -->
						<!--<div style="padding-top:120px ;padding-left: 300px;"> SCORE for last 12 months : //if($totalscore12 != 0){echo ($score12 / $totalscore12)*100 . "%";}else {echo "δεν υπαρχουν εγγραφες για τους τελευταιους 12 μηνες";} ?>  </div>	-->

						 <div style=" padding-left: 200px; ">
							 <table id='tbl' class="table">
 							 <thead style=" padding-left: 200px; width:20px;">
	 						 <tr style="font-size:small;">

		 				 	 <th style="font-size:small;" scope="col">IN_VEHICLE</th>
		 			     <th style="font-size:small;" scope="col">ON_BICYCLE</th>
			 	 		   <th style="font-size:small;" scope="col">ON_FOOT</th>
							 <th style="font-size:small;" scope="col">RUNNING</th>
							 <th style="font-size:small;" scope="col">STILL</th>
							 <th style="font-size:small;" scope="col">TILTING</th>
							 <th style="font-size:small;" scope="col">UNKNOWN</th>
							 <th style="font-size:small;" scope="col">WALKING</th>
							 <th style="font-size:small;" scope="col">EXITING_VEHICLE</th>
							 <th style="font-size:small;" scope="col">IN_ROAD_VEHICLE</th>
							 <th style="font-size:small;" scope="col">IN_FOUR_WHEELER_VEHICLE</th>
							 <th style="font-size:small;" scope="col">IN_TWO_WHEELER_VEHICLE</th>
							 <th style="font-size:small;" scope="col">IN_BUS</th>
							 <th style="font-size:small;" scope="col">IN_CAR</th>
	 			       </tr>
 			         </thead >
 						 	 <tbody >
    				 	 <tr>
               </tr>
	  			 	 </tbody>
						 </table>
						 <table id='tbl2' class="table">
						 <thead style=" padding-left: 200px; width:20px;">
						 <tr style="font-size:small;">

						 <th style="font-size:small;" scope="col">IN_VEHICLE</th>
						 <th style="font-size:small;" scope="col">ON_BICYCLE</th>
						 <th style="font-size:small;" scope="col">ON_FOOT</th>
						 <th style="font-size:small;" scope="col">RUNNING</th>
						 <th style="font-size:small;" scope="col">STILL</th>
						 <th style="font-size:small;" scope="col">TILTING</th>
						 <th style="font-size:small;" scope="col">UNKNOWN</th>
						 <th style="font-size:small;" scope="col">WALKING</th>
						 <th style="font-size:small;" scope="col">EXITING_VEHICLE</th>
						 <th style="font-size:small;" scope="col">IN_ROAD_VEHICLE</th>
						 <th style="font-size:small;" scope="col">IN_FOUR_WHEELER_VEHICLE</th>
						 <th style="font-size:small;" scope="col">IN_TWO_WHEELER_VEHICLE</th>
						 <th style="font-size:small;" scope="col">IN_BUS</th>
						 <th style="font-size:small;" scope="col">IN_CAR</th>
						 </tr>
						 </thead >
						 <tbody >
						 <tr>
						 </tr>
					 </tbody>
					 </table>
					 <table id='tbl3' class="table">
					 <thead style=" padding-left: 200px; width:20px;">
					 <tr style="font-size:small;">

					 <th style="font-size:small;" scope="col">IN_VEHICLE</th>
					 <th style="font-size:small;" scope="col">ON_BICYCLE</th>
					 <th style="font-size:small;" scope="col">ON_FOOT</th>
					 <th style="font-size:small;" scope="col">RUNNING</th>
					 <th style="font-size:small;" scope="col">STILL</th>
					 <th style="font-size:small;" scope="col">TILTING</th>
					 <th style="font-size:small;" scope="col">UNKNOWN</th>
					 <th style="font-size:small;" scope="col">WALKING</th>
					 <th style="font-size:small;" scope="col">EXITING_VEHICLE</th>
					 <th style="font-size:small;" scope="col">IN_ROAD_VEHICLE</th>
					 <th style="font-size:small;" scope="col">IN_FOUR_WHEELER_VEHICLE</th>
					 <th style="font-size:small;" scope="col">IN_TWO_WHEELER_VEHICLE</th>
					 <th style="font-size:small;" scope="col">IN_BUS</th>
					 <th style="font-size:small;" scope="col">IN_CAR</th>
					 </tr>
					 </thead >
					 <tbody >
					 <tr>
					 </tr>
				 </tbody>
				 </table>
						 </div>

						 <div id="mapid"></div>
						 <link rel="stylesheet" href="js/datepicker/css/datepicker.css" />
		<script src="js/datepicker/js/bootstrap-datepicker.js"></script>

		<script>
		//var HeatmapOverlay = require('leaflet-heatmap');
		var map = L.map('mapid').setView([38.2462420, 21.7350847], 16);

		L.tileLayer(
		'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: 'Data © <a href="http://osm.org/copyright">OpenStreetMap</a>',
			maxZoom: 18
		}).addTo(map);

		let cfg = {
	 // radius should be small ONLY if scaleRadius is true (or small radius is intended)
	 // if scaleRadius is false it will be the constant radius used in pixels
	 "radius": 2,
	 "maxOpacity": .8,
	 // scales the radius based on map zoom
	 "scaleRadius": true,
	 // if set to false the heatmap uses the global maximum for colorization
	 // if activated: uses the data maximum within the current map boundaries
	 //   (there will always be a red spot with useLocalExtremas true)
	 "useLocalExtrema": true,
	 // which field name in your data represents the latitude - default "lat"
	 latField: 'lat',
	 // which field name in your data represents the longitude - default "lng"
	 lngField: 'lng',
	 // which field name in your data represents the data value - default "value"
	 valueField: 'count'
	 };


// 		var map =  L.Map('mapid', {
//   center: new L.LatLng(38.2462420, 21.7350847),
//   zoom: 16,
//   layers: [baseLayer]
// });

        $('#startdate_datepicker').datepicker({


						viewMode: 'years',
						minViewMode: 'months',
	          format: 'yyyy-mm-dd',

        });
				$('#enddate_datepicker').datepicker({

						viewMode: 'years',
						minViewMode: 'months',
	          format: 'yyyy-mm-dd',

        })
				.on('show', function (ev) {
        ev.stopPropagation();
    })
				.on('changeDate',function(ev)
			{
					if(ev.viewMode== 'months')
					{
							var endingDate = new Date(ev.date);
							var endingMonth = endingDate.getMonth();
							var endingYear = endingDate.getFullYear();
							if(endingMonth == 0 || endingMonth == 2 || endingMonth == 4 || endingMonth == 6 || endingMonth == 7 || endingMonth == 9 || endingMonth == 11){

							var endingDay = endingDate.getDay() + 30;
						}
						else if (endingMonth == 1) {
							var endingDay = endingDate.getDay() + 27;
						}
						else {
							var endingDay = endingDate.getDay() + 29;
						  }
							endingDate = new Date(endingYear,endingMonth,endingDay);
							$('#enddate_datepicker').datepicker('setValue',endingDate);;
							$('#enddate_datepicker').datepicker('hide');
					}
			});
    </script>
		<script>
		window.onload = function(e){e.preventDefault();}


		$('#btn').on('click',function(e){
			var ready = false;
			var	startdate = $('#startdate_datepicker').val()
			alert(startdate);
			var	enddate = $('#enddate_datepicker').val()
			alert(enddate);
			if(startdate != null && enddate != null){
				ready = true ;

				$.ajax({
					type:'POST',
					url : 'actions/useractivity.php',
					data: {startdate : startdate, enddate : enddate},

					success: function(data){
								alert(data);
								var php = JSON.parse(data);
								 var datachart = [];
								 $("#tbl").find('td').each(function(){$(this).remove();});
								 $("#tbl2").find('td').each(function(){$(this).remove();});
								 $("#tbl3").find('td').each(function(){$(this).remove();});
								 for(i = 0; i<=13; i++){
				 					var markup = "<td>" + php[i] + "</td>";
				 					$("#tbl").find('tbody').append(markup);
				 				}
								for(i=14; i<=27; i++){
									if(php[i] == null){
										php[i] = 0;
									}
									var markup = "<td>" + php[i] + "</td>";
				 					$("#tbl2").find('tbody').append(markup);

								}
								for(i=28; i<=41; i++){
									if(php[i] == null){
										php[i] = 0;
									}
									var markup = "<td>" + php[i] + "</td>";
				 					$("#tbl3").find('tbody').append(markup);
								}

							},
					error: function(data){
								Swal.fire({
									title: 'ERROR',
									text : 'Some errors have accured. Try again!',
									type : 'error'
								})
							}
				});

				$.ajax({
					type:'POST',
					url : 'actions/heatmap.php',
					data: {startdate : startdate, enddate : enddate},
					success: function(data){
								heatmapdata = data;
								var mapData = {
					 			 max: 8,
					 			 data : heatmapdata
					 		 }
							 let heatmapLayer = new HeatMapOverlay(cfg);
							 map.addLayer(heatmapLayer);
					 	 	 heatmapLayer.setData(mapData);
		// 			 var heat = L.heatLayer(data, { radius: 35 });
    // map.addLayer(heat);
							},
					error: function(data){
								Swal.fire({
									title: 'ERROR',
									text : 'Some errors have accured. Try again!',
									type : 'error'
								})
							}
				});
			}
			else{
				alert('Πρεπει να εισάχθει πρώτα η ημερομηνία/ίες');
			}

		 })

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
#startdate_datepicker{
	margin-top: 20px;
	margin-left: 200px;
}
#enddate_datepicker{
	margin-top: 20px;
	margin-left: 200px;

}
.table{
	padding-top:80px ;padding-left: 200px; width:200px;
}
.start_date{
	width: 500px;
}
.end_date{
	width: 500px;
}
#ar{
	padding-top: 100px;
	padding-left: 200px;
}
#mapid {
	height: 400px;
				margin-top: 80px;
				margin-left: 200px;
				margin-right: 700px;
				width: 700px;
 }

.canvasjs-chart-toolbar{
	padding-right: 300px;
}
</style>
</body>
</html>

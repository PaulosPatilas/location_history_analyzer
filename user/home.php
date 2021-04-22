<?php
include('session.php');
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
	                <ul class="navbar-nav navbar-left" style="background-color: steelblue;">

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
						<div style="padding-top: 100px;"class="container">
							<div class = "row">
							<div class="card">
							<div class="card-header">Score οικολογικής μετακίνησης</div>
  						<div class="card-body">
								<h4 class = "small font-weight-bold"> Μηναιο score <span class="float-right"> <?php echo $score?> %</span> </h4>
							<div style = "max-width:700px;" class="progress">
	  						<div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $score?>% "></div>
						</div>
							<h4 class = "small font-weight-bold"> Ετησιο score <span class="float-right"> <?php echo $score12?> %</span> </h4>
						<div style = "max-width:700px;" class="progress">
    					<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $score12?>%"> </div>
  					</div>
						<hr class = 'mb-3'>
						<div> H περίοδος που καλύπτουν οι εγγραφές : <?php print_r($minimumdate)  ?> έως <?php print_r($maximumdate) ?></div>
						<hr class = 'mb-3'>
						<div> H ημερομηνία τελευταίου upload : <?php echo $latestupload; ?></div>
					</div>
				</div>
</div>
<div class = "row">

						<!--<div style="padding-top:120px ;padding-left: 300px;"> SCORE for last 12 months : //if($totalscore12 != 0){echo ($score12 / $totalscore12)*100 . "%";}else {echo "δεν υπαρχουν εγγραφες για τους τελευταιους 12 μηνες";} ?>  </div>	-->
						<!-- <div id="chartContainer" style="height: 370px; width: 700px; padding-top:100px ;padding-left: 300px"></div> -->
					</div>
				</div>

		<!-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
		<script>
		window.onload = function () {

		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			exportEnabled: true,
			theme: "light1", // "light1", "light2", "dark1", "dark2"
			title:{
				text: "Simple Column Chart with Index Labels"
			},
			data: [{
				type: "column", //change type to bar, line, area, pie, etc
				//indexLabel: "{y}", //Shows y value on all Data Points
				indexLabelFontColor: "#5A5757",
				indexLabelPlacement: "outside",
				dataPoints: //< echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
			}]
		});
		chart.render();

		}
		</script> -->
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


.canvasjs-chart-toolbar{
	padding-left: 50px;
}
</style>
	</body>
</html>

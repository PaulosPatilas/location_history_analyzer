<?php

include('session.php');
if(!isset($_SESSION['username'])){
	header("location: login-form.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title> Home Page </title>
</head>
	<body>
		<!DOCTYPE html>
		<html>
		<head>
			<title> Home Page </title>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
			<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		</head>

			<body>
				<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: steelblue  ; border-bottom-width: 2px;  border-bottom-color: steelblue; ">
			        <div class="container-fluid">
			            <div class="navbar-header">
			                <h4 style="color:black;"><small style="color:white; margin-left: 10px;">Version 1.2.0</small></h4>
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
								<div style="padding-left: 200px;">
									<table id='total' class="table">
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
<script>
window.onload = function(){

	$.ajax({
		type:'POST',
		url : 'actions/totalactivity.php',
		success:function(data){
			var total = JSON.parse(data);
			 var datachart = [];
			 $("#total").find('td').each(function(){$(this).remove();});
			 for(i = 0; i<=13; i++){
				var markup = "<td>" + total[i] + "</td>";
				$("#total").find('tbody').append(markup);
			}

		},
		error:function(data){}
	});
}

</script>
	</body>
</html>

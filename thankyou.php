<?php

$databasehost = "localhost:3306";
$databasename = "test";
$databaseusername ="root";
$databasepassword = "";

$con = mysql_connect($databasehost,$databaseusername,$databasepassword) or die(mysql_error());
mysql_select_db($databasename) or die(mysql_error());
#mysql_query("SET CHARACTER SET utf8;");

$description = $_POST["firstname"] . " " . $_POST["lastname"] . " " . $_POST["phone"] . " " . $_POST["email"];
mysql_query("INSERT INTO SCHEDULE VALUES(\"" . $_POST["apptime"] . "\",\"" .  $_POST["endtime"] . "\",\"" . $description . "\",\"" . "patient" . "\");");	
mysql_close($con);

?>

<!DOCTYPE HTML>

<html>
<head>
        <title>Andrey Aleynikov</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="css/reset.css" type="text/css" rel="stylesheet">
        <link href="css/styles.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="js/jquery-1.4.4.js"></script>

</head>
<body>
		<div id="fixed_stripe">
				<header id="fixed_stripe_center">
						<a id="a_logo" href="#"><img src="img/logo.png"></a>
						<menu id="menu">
								<ul>
									<li><a href="index.html" id="a_about">about</a></li>
									<li><a href="services.html" id="a_services">services</a></li>
									<li><a href="massage.html" id="a_massage">wellness massage</a></li>
									<li><a href="reference.html" id="a_massage">reference</a></li>
									<li><a href="contacts.html" id="a_contacts">contacts</a></li>
								</ul>
						</menu>						
				</header>
		</div>
		<!--<br><br><br><br><br><br>-->
		<div id="empty_stripe"></div>

				<div id="contacts">
					<h1>Appointment booked.</h1>
                     <div style="height:100px"></div> <div style="height:50px"></div>
					 <div style="text-align:center">
					<p id="p_big">
					
                        Thank you for scheduling an appointment with us!  We look forward to working with you, and if, for any reason, you'd like to cancel your appointment, please call (616) 550-6819 or email andreywestmich@gmail.com.
                      
					</p>
					 </div>
					<br>
					
					</p>
					<br><br>
					
                    <div style="height:100px"></div>
                    
                
					<div id="footer_stripe"></div>
					<a id="a_amta_logo" href="http://www.amtamassage.org/index.html"><img id="img_amta_logo" src="img/amta_logo.png"></a>
					<p id="p_serving">Serving in Grand Rapids and West Michigan</p>
				</div>

	</body>
</html>
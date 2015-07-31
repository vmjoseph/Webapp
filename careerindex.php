<head>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link href='http://fonts.googleapis.com/css?family=Lato|Quattrocento+Sans|Oxygen|Hind|Raleway' rel='stylesheet' type='text/css'>
	<script src="career.js"></script>
</head>
		<!--Include header on each page-->
		<?php include("header.html");?>
<body>
	<!--User Information Section-->
	<section class="userSection">
		<center><img class="profilePic" src="images/profile.png"></center>
			<table class="userHolder">
				<tr class="userStrip"><td>Username:</td><td style="text-align:left"><?php echo $_SESSION['username'];?> </td></tr>
				<tr class="userStrip"><td>First Name:</td><td style="text-align:left"><?php echo $_SESSION['firstName'];?> </td></tr>
				<tr class="userStrip"><td>Last Name:</td><td style="text-align:left"><?php echo $_SESSION['lastname'];?> </td></tr>
				<tr class="userStrip"><td>Email:</td><td style="text-align:left"><span class="emailClass"><?php echo $_SESSION['email'];?></span> </td></tr>
			</table>
	</section>
	<!--Secondary Menu under Nav Bar-->
	<section class="quickAccess">
		<div class="accessIconHolder">
			<center>
				<a class="quickLink" href="weeklyreport.php"><div class="iconHolder">
				<img class="icon"src="images/chart42.png"/>
				<span class="caption">Weekly Reports</span>
				</div></a>
				<a class="quickLink" href="index.1.html"><div class="iconHolder">
				<img class="icon"src="images/medical50.png"/>
				<span class="caption">Attendance</span>
				</div></a>
				<a class="quickLink" href="credentials.php"><div class="iconHolder">
				<img class="icon"src="images/configuration21.png"/>
				<span class="caption">Login Info</span>
				</div></a>
				<a class="quickLink" href="graduated.php"><div class="iconHolder2">
				<img class="icon"src="images/Female_graduate_student_128.png"/>
				<span class="caption">Graduated Students</span>
				</div></a>
			</center>
		</div>
	</section>
	<!--Class Information Section-->
	<section class="blockHolder">
		<center>
			<a class="quickLink" href="wtp.php"><div class="blocks">
			<img class="quick2" src="images/woman-hand-smartphone-desk.jpg">
			<span class="caption2">WTP Resources</span>
			</div></a>
			<a class="quickLink" href="welding.php"><div class="blocks">
			<img class="quick2" src="images/welding.jpg">
			<span class="caption2">Welding Resources</span>
			</div></a>
			<a class="quickLink" href="info.php"><div class="blocks">
			<img class="quick3" src="images/info.png">
			<span class="caption2">Class Information</span>
			</div></a>
		</center>
	</section>
	<!--Updates and Calendar -->
	<section class="quickAccess2">
		<iframe class="calendar "src="https://www.google.com/calendar/embed?showTitle=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=mos.cpc.tbcs%40gmail.com&amp;color=%23125A12&amp;src=en.usa%23holiday%40group.v.calendar.google.com&amp;color=%23125A12&amp;ctz=America%2FNew_York" 
		style=" border-width:0 " width="300" height="300" frameborder="0" scrolling="no"></iframe>
			<div class="recentNews"><h1 class="newsHead">Recent Updates:</h1>
				<table>
					<tr><Td class="title"> TimeSheeet App:</td><td class="description"> Student Registration Active</td></tr>
					<tr><Td class="title"> TimeSheeet App:</td><td class="description"> Edit Times Active</td></tr>
					<tr><Td class="title"> Weekly Reports</td><td class="description"> One-Drive Link Created</td></tr>
					<tr><Td class="title"> WTP Reports:</td><td class="description"> One-Drive Link Create</td></tr>
					<tr><Td class="title"> Welding Reports:</td><td class="description"> Update One-Drive Link Create</td></tr>
					<tr><Td class="title"> Update Name:</td><td class="description"> Update Content</td></tr>
				</table>
			</div>
	</section>
</body>
<!--Include Footer on each Page-->
<?php include("footer.html");?>
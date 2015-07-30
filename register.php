<?date_default_timezone_set('America/New_York');?>
 
<?php include("header3.html");?>
<body onload="set_style_from_cookie()">

	<form action="logtest.php" method="POST" id="registrationForm">
		<h1> Registration </h1>
			<table class="creating">
				<tr><td>First Name:</td><td><input type="text" name="firstN" id="firstName"></td><Td><span id="nameNeeded" class="errorMessage"></span></td></td></tr>
				<tr><td>Last Name:</td><td><input type="text" name="lastN" id="lastName"></td></td><Td><span id="nameNeeded2"class="errorMessage"> </span></td></td></tr>
				<tr><td>Username:</td><td><input type="text" name="userN" id="userName"></td></td><Td><span id="nameNeeded3" class="errorMessage"> </span></td></td></tr>
				<tr><td>Email:</td><td><input type="text" name="emailAddress" id="emailAddress"></td><Td><span id="nameNeeded4" class="errorMessage"> </span></td></td></tr>
				<tr><td>Password:</td><td><input type="password" name="pass" id="password1"></td><Td><span id="nameNeeded5" class="errorMessage"> </span></td></td></tr>
				<tr><td>Confirm Password:</td><td><input type="password" name="passConfirm" id="passwordConfirm"class=""></td><Td><span id="nameNeeded6" class="errorMessage"> </span></td></td></tr>
				<tr><td colspan="2">
				<tr><Td></tr>
			</table>

	</form>
				<button id="submit" onclick="subMit()" >"Register"</button></td>
</body>	
<?php include("footer.html");?>


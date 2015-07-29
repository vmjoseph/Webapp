<?php //include("header.html");?>
<?php
//session_start();

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<link href='http://fonts.googleapis.com/css?family=Lato|Quattrocento+Sans|Oxygen|Hind|Raleway' rel='stylesheet' type='text/css'>
<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
<script src="career.js"></script>
</head>
<body onload="fadeUp()">
<form id="login" class="login" action="logCheck.php" method="POST"><center>
<div id="titleArea"><img src="cpcworkspacelogo.png" class="t2"></div></center>
<center>
<table class="logTable">
<tr><td colspan="2"><input type="text" class="field" value="username" onclick='javascript: this.value = ""' name="user"></td></tr>
<tr><td colspan="2"><input type="password" class="field" onclick='javascript: this.value = ""'  value="password" name="pass"></td></tr>
<tr><td></td><td colspan="2"><input type="submit" name="login" value="Login"></td></tr>
<tr><td></td><td colspan="2">Don't have an account?<a href="register.php"> Register Here</a></td></tr>
<tr><td></td><td colspan="2">Forgot your username/password?<a href="register.php"> Click Here</a></td></tr>
</table>
</center>
</form>
</body>
</html>
<?php include("footer.html");?>
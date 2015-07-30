<head>
<link rel="stylesheet" type="text/css" href="styles.css">
<link href='http://fonts.googleapis.com/css?family=Lato|Quattrocento+Sans|Oxygen|Hind|Raleway' rel='stylesheet' type='text/css'>
<script src="career.js"></script>
</head>
<?php
include("header3.html");
$dsn = "pgsql:"
    . "host=ec2-107-21-125-143.compute-1.amazonaws.com;"
    . "dbname=deadm3k5bm4tsv;"
    . "user=dvkcevygfoffdp;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=T00C1WPiv8B2-EdRQkSTl_WIkT";
 


    // Create connection
    $db =  new PDO($dsn);

    // Check connection
$dbconn = pg_connect("host=ec2-107-21-125-143.compute-1.amazonaws.com dbname=deadm3k5bm4tsv user=dvkcevygfoffdp password=T00C1WPiv8B2-EdRQkSTl_WIkT")


        or die('Could not connect: ' . pg_last_error());
        
    if ($dbconn->pg_last_error){
        echo "<br> Sorry, unable to connect:".pg_last_error;
    } else {
        //echo "Connected securely.";
    }
    
$user=$_POST['userN'];
$pass=$_POST['pass'];
$email=$_POST["emailAddress"];
$firstN=$_POST['firstN'];
$lastN=$_POST['lastN'];
$currentDate=date("l jS \of F Y h:i:s A");

$resultRegister= pg_query($dbconn,"INSERT INTO userdata (username, password, email, First_name, Last_name, account_creation_date)
VALUES ('$user', '$pass','$email','$firstN','$lastN','$currentDate')");
if (!$resultRegister) {
   
   echo "<script>window.location.replace('redirect.php');</script>";
      //echo "<br><br><br><br>You will be redirected in 5 seconds. If not, please click <a href='login.php'>here</a>.";
	  include("footer.html");
	  #sleep(5);
} else {
      echo "<script>window.location.replace('redirect.php');</script>";
    //echo "The following error has occured:" ."Error: " . $resultRegister . " <br> ".($db);
}
// sleep(5);

//  $result->closeCursor();

?>

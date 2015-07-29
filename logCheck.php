<?php
date_default_timezone_set("America/New_York");

// establishing the MySQLi connection



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
                echo "Connected securely.<br>";
            }
    //Login Button
        if(isset($_POST['login'])){
        //Create vars for post strings
            $username = pg_escape_string($dbconn,$_POST['user']);
            $pass = pg_escape_string($dbconn , $_POST["pass"]);
            
            
            $sel_user = "select * from userdata where username='".$username."' AND password='".$pass."'";
            
            $run_user = pg_query($dbconn, $sel_user);
            
            $check_user = pg_num_rows($run_user);
        //Query to check user against the database
           
           echo "<br>".$username."<br>".$pass;
           echo "<br>".$check_user;
    //Check User Data Table 
            if($check_user>0){
            echo "<script> alert(Congrats! You exist!);</script>";
            } else {
                echo "<script>window.location.assign('login.php')</script>";
                echo "<script> alert(Sorry! You don't exist!);</script>";
                echo "<script> console.log('Sorry! You don't exist!');</script>";
            }


        }
?>
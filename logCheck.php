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
           echo "<br>".$check_user."<br>";
           
           
    //Check User Data Table 
            if($check_user>0){
                session_start();
                //username for session
                $_SESSION['username']=$_POST['user'];
                echo  $_SESSION['username']."<br>";
         #User Email       
        //grabbibng email query
            $queryEmail= "SELECT email FROM userdata WHERE username='$username' AND password='$pass'";
            //Grabs the result of the query
                $resultEmail = $db->query($queryEmail);
                while ($row = $resultEmail->fetch(PDO::FETCH_ASSOC)) {
                //creates email var from fetched db result
                $emailAddress=$row["email"];
                }
                //creates email session var
                $_SESSION['email']=$emailAddress;
                //test echo
                 echo $emailAddress."<br>";
                 
        #User First Name
            $queryFirstName= "SELECT first_name FROM userdata WHERE username='$username' AND  password='$pass'";
            //Grabs the result of the query
                $resultFirstName= $db->query($queryFirstName);
                while ($row = $resultFirstName->fetch(PDO::FETCH_ASSOC)){
                    //creates first name var from fetched db result
                    $firstN=$row["first_name"];
                }
                //creates first name session var 
                $_SESSION['firstName']=$firstN;
                //test echo
                 echo $firstN."<br>"; 
                 
        #User Last Name
            $queryLastName= "SELECT last_name FROM userdata WHERE username='$username' AND  password='$pass'";
            //Grabs the result of the query
                $resultLastName= $db->query($queryLastName);
                while ($row = $resultLastName->fetch(PDO::FETCH_ASSOC)){
                    //creates first name var from fetched db result
                    $lastN=$row["last_name"];
                }
                //creates first name session var 
                $_SESSION['lastname']=$lastN;
                //test echo
                 echo $lastN."<br>"; 
                 
        #User Log Time
        $currentDate=date("M , j , D , H:i A");
        echo $currentDate;
        
        //  $resultTime= pg_query($dbconn,"UPDATE last_login FROM userdata SET last_login = '$currentDate' WHERE username='$username' AND password='$pass'");
        //  if (!$resultTime){
             
        //  }
            
            // echo "<script> alert('Congrats! You exist!');</script>";
            echo "<script>window.open('careerindex.php','_self')</script>";
            } else {
                
                echo "<script> alert('Sorry! Incorrect user/password!');</script>";
                echo "<script>window.location.assign('login.php');</script>";
               
            }


        }
?>
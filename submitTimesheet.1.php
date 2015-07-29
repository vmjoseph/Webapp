<?php
$last=$_POST['last'];
$first=$_POST['first'];
$gender=$_POST['genders'];
$section=$_POST['selectionForSection'];
$sid=$_POST['sIDNumber'];
$last4=$_POST['lastfour'];
?>
<?php include 'header.html';?>
<?php
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
        echo "Connected securely.";
    }
   ?>
       <section class="newProfile">
<?php 
echo "<section id='avatarHolder'>";
if ($gender==="Female"){
    echo "<img class='avatarIcon' src='femaleIcon.png'>";
}else {
    echo "<img class='avatarIcon' src='maleIcon.png'>"; 
}
echo "</section>";
?>
<div id="info"><b>Name:</b> <?php echo " ".$first." ".$last;?> <br>
<b>Gender:</b> <?php echo " ".$gender;?><br>
<b>SID: </b><?php echo " ".$section.$sid; ?></div>
</section>

<?php 
$result = pg_query($dbconn, "INSERT INTO students (first_name, last_name, section_type, sid,gender ) 
                  VALUES('$first','$last','$section','$sid','$gender');");




//dump the result object
// var_dump($result);
if (!$result) {
 echo "<div class='successCheck'>New student was not created!<br> The following error has occured:"."Error: ". $sql2 . " <br> ".$result.($db)."!</div>";
exit;
}else{
   
echo "<div class='successCheck'>New student created successfully!<div class='return'>Click Here to Return <a class='noDecoration2'href='index.html'><img src='return.png'></a></div></div>";
    
}
// Closing connection
pg_close($dbconn);



 //$result2= pg_query($dbconn,"INSERT INTO student_hours2 (sID, last_name, first_name, last_four ,section) 
         //       VALUES ('$sid','$last','$first','$last4','$section')");
                
// var_dump($result);

// Closing connection
//pg_close($dbconn);
    // if (mysqli_query($db, $sql2)){
    //     echo "<div class='successCheck'>New student created successfully!<div class='return'>Click Here to Return <a class='noDecoration2'href='index.html'><img src='return.png'></a></div></div>";
    // } else {
    //     echo "<div class='successCheck'>New student was not created!<br> The following error has occured:"."Error: ". $sql2 . " <br> ".mysqli_error($db)."!</div>";
    //     # echo "Error: ". $sql2 . " <br> ".mysqli_error($db);
    // }

    
    
    ?>
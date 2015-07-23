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
 $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "attendance";
    $dbport = 3306;

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
    echo "";
    #TRUNCATE TABLE students
    #INSERT INTO students(last_name, first_name, section_type, sid, gender)VALUES('$last','$first','$section','$sid','$gender')
   
    #TRUNCATE TABLE student_hours
#INSERT INTO student_hours (sID, last_name, first_name, last_four ,section)
   # VALUES ('$sid','$last','$first','$last4','$section')
   ?>
       <section class="newProfile">
<!--<img class="avatarIcon"src="maleIcon.png">-->
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
 $sql= "INSERT INTO students(last_name, first_name, section_type, sid, gender)VALUES('$last','$first','$section','$sid','$gender')";
    
    if (mysqli_query($db, $sql)) {
    echo "";
} else {
    echo "<div class='successCheck'>Error: " . $sql . "<br>" . mysqli_error($db)."!</div>";
}

 $sql2="INSERT INTO student_hours (sID, last_name, first_name, last_four ,section) VALUES ('$sid','$last','$first','$last4','$section')";
    if (mysqli_query($db, $sql2)){
        echo "<div class='successCheck'>New student created successfully!<div class='return'>Click Here to Return <a class='noDecoration'href='index.html'><img src='return.png'></a></div></div>";
    } else {
        echo "<div class='successCheck'>New student was not created!<br> The following error has occured:"."Error: ". $sql2 . " <br> ".mysqli_error($db)."!</div>";
        # echo "Error: ". $sql2 . " <br> ".mysqli_error($db);
    }

    
    
    ?>
<?php
$last=$_POST['last'];
$first=$_POST['first'];
$gender=$_POST['genders'];
$section=$_POST['selectionForSection'];
$sid=$_POST['sIDNumber'];
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
    echo "Connected successfully (".$db->host_info.")";
    #TRUNCATE TABLE students
    $sql= "INSERT INTO students(last_name, first_name, section_type, sid, gender)
    VALUES('$last','$first','$section','$sid','$gender')";
    
    if (mysqli_query($db, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
}

    
    
    ?>
Name: <?php echo $first." ".$last;?> <br>
Gender: <?php echo $gender;?><br>
SID: <?php echo $section.$sid; ?>

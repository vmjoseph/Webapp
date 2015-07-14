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
        echo "Connected successfully (".$db->host_info.")"."<br>";
    
    $sql = "SELECT sID, last_name, first_name, mon, tue, wed, tue, thurs, fri, week_total, last_four, section FROM student_hours";
    $result = $db->query($sql);
    
    if ($result->num_rows > 0) {
    // output data of each row
    echo "<select name='studentNames'>";
    while($row = $result->fetch_assoc()) {
       echo "<option value=".$row["first_name"].">" .$row["first_name"]. "</option>";
    }echo "</select>";
    } else {
    echo "0 results";
    }
    $sql2="SELECT last_name WHERE first_name='Vallie' FROM student_hours ";
    
    $db->close();
?>
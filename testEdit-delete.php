<?php 
include 'header.html';


    ?>
<?php
    //Set Timezone
    date_default_timezone_set('America/New_York');
    //Server connection
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
    //Start HTML
    echo "<h1>View Student Times</h1>";
    //Sql statement to grab all items from the database from student_hours table
    $sql = "SELECT sID, last_name, first_name, mon, tue, wed, tue, thurs, fri, week_total, last_four, section FROM student_hours";
    //Grabs the result of the query
    $result = $db->query($sql); 
    if ($result->num_rows > 0) {
    // output data of each row
    echo "<table class='viewTimeTable' id='viewTimeTable'>";
    echo "<tr><th class='hide'>First Name</th><th class='editClass'>sID</th><th class='editClass'>Last Name </th><th class='editClass'> First Name </th>
    <th class='editClass'> Mon </th> <th class='editClass'> Tue </th> <th class='editClass'> Wed </th> <th class='editClass'> Thurs </th> 
    <th class='editClass'> Fri </th> <th class='editClass'> Week Total </th> <th class='editClass'> Last Four </th>
    <th class='editClass'> Section </th><th class='editClass'> Delete </th><th class='editClass'> Export </th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr class='editClass'><td class='editClass'>". $row["sID"]. "</td> <td class='editClass'>" . $row["last_name"]. "</td>
        <td class='editClass'> ".$row["first_name"]."</td> <td class='editClass'>". $row["mon"]."</td> <td class='editClass'>".
        $row["tue"]."</td> <td class='editClass'>".$row["wed"]."</td> <td class='editClass'>".$row["thurs"]."</td> <td class='editClass'>".
        $row["fri"]."</td> <td class='editClass'>".$row["week_total"]."</td> <td class='editClass'>".$row["last_four"]."</td>
        <td class='editClass'>".$row["section"]."</td><td>
        <img class='remove' src='remove.png'><br><input type='submit' name='remove' value='delete'></td><td><img src='pdf17.png' class='pdf'>
        </td></tr>";
     
     
    }echo "</table>";
    
    } else {
    echo "0 results";
    }
    
     
     
    $downloadButton = "<form action='editSheet.php' method='GET'>
    <input type='submit' name='download' class='download' id='download' value='Download Timesheet'>
    </form>";
    echo $downloadButton;
    
    if (isset($_POST['remove'])){
        
        echo "<script>alert('$firstName '+'removed');</script>";
    }else{
        
    }
    
    if(isset($_GET['download'])){
   
   

    }else {
    
    }
        $db->close();
?>
<?php 
include 'pullOutmenu.html';
?> 
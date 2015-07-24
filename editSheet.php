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
    echo "<tr><th class='editClass'>sID</th><th class='editClass'>Last Name </th><th class='editClass'> First Name </th><th class='editClass'> Mon </th> <th class='editClass'> Tue </th> <th class='editClass'> Wed </th> <th class='editClass'> Thurs </th> <th class='editClass'> Fri </th> <th class='editClass'> Week Total </th> <th class='editClass'> Last Four </th> <th class='editClass'> Section </th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr class='editClass'> <td class='editClass'>". $row["sID"]. "</td> <td class='editClass'>" . $row["last_name"]. "</td> <td class='editClass'> " . $row["first_name"]. "</td> <td class='editClass'>". $row["mon"]."</td> <td class='editClass'>".$row["tue"]."</td> <td class='editClass'>".$row["wed"]."</td> <td class='editClass'>".$row["thurs"]."</td> <td class='editClass'>".$row["fri"]."</td> <td class='editClass'>".$row["week_total"]."</td> <td class='editClass'>".$row["last_four"]."</td> <td class='editClass'>".$row["section"]."</td></tr>";
    $extractedTable= "<tr class='editClass'> <td class='editClass'>". $row["sID"]. "</td> <td class='editClass'>" . $row["last_name"]. "</td> <td class='editClass'> " . $row["first_name"]. "</td> <td class='editClass'>". $row["mon"]."</td> <td class='editClass'>".$row["tue"]."</td> <td class='editClass'>".$row["wed"]."</td> <td class='editClass'>".$row["thurs"]."</td> <td class='editClass'>".$row["fri"]."</td> <td class='editClass'>".$row["week_total"]."</td> <td class='editClass'>".$row["last_four"]."</td> <td class='editClass'>".$row["section"]."</td></tr>";
      
    }echo "</table>";
    
    } else {
    echo "0 results";
    }
    $downloadButton = "<form action='editSheet.php' method='GET'>
    <input type='submit' name='download' class='download' id='download' value='Download Timesheet'>
    </form>";
    echo $downloadButton;
    if(isset($_GET['download'])){
   
   
    // $file="timesheet_".date("m/d").".xls";
    // header("Content-type: application/vnd.ms-excel"); 
    // header("Content-Disposition: attachment; filename=$file"); 
    //  ob_clean();
    // echo $extractedTable;
    
    //<table class='viewTimeTable' id='viewTimeTable'>"."<tr><th class='editClass'>sID</th><th class='editClass'>Last Name </th><th class='editClass'> First Name </th><th class='editClass'> Mon </th> <th class='editClass'> Tue </th> <th class='editClass'> Wed </th> <th class='editClass'> Thurs </th> <th class='editClass'> Fri </th> <th class='editClass'> Week Total </th> <th class='editClass'> Last Four </th> <th class='editClass'> Section </th></tr>".$extractedTable."</table>
        ob_clean();
        $file="timesheet_".date("m/d").".xls";
        $tableExport="<table class='viewTimeTable' id='viewTimeTable'>".$extractedTable."</table>";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file");
$sql = "SELECT sID, last_name, first_name, mon, tue, wed, tue, thurs, fri, week_total, last_four, section FROM student_hours";
    //Grabs the result of the query
    $result = $db->query($sql); 
    if ($result->num_rows > 0) {
    // output data of each row
    echo "<table class='viewTimeTable' id='viewTimeTable'>";
    echo "<tr><th class='editClass'>sID</th><th class='editClass'>Last Name </th><th class='editClass'> First Name </th><th class='editClass'> Mon </th> <th class='editClass'> Tue </th> <th class='editClass'> Wed </th> <th class='editClass'> Thurs </th> <th class='editClass'> Fri </th> <th class='editClass'> Week Total </th> <th class='editClass'> Last Four </th> <th class='editClass'> Section </th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr class='editClass'> <td class='editClass'>". $row["sID"]. "</td> <td class='editClass'>" . $row["last_name"]. "</td> <td class='editClass'> " . $row["first_name"]. "</td> <td class='editClass'>". $row["mon"]."</td> <td class='editClass'>".$row["tue"]."</td> <td class='editClass'>".$row["wed"]."</td> <td class='editClass'>".$row["thurs"]."</td> <td class='editClass'>".$row["fri"]."</td> <td class='editClass'>".$row["week_total"]."</td> <td class='editClass'>".$row["last_four"]."</td> <td class='editClass'>".$row["section"]."</td></tr>";
    $extractedTable= "<tr class='editClass'> <td class='editClass'>". $row["sID"]. "</td> <td class='editClass'>" . $row["last_name"]. "</td> <td class='editClass'> " . $row["first_name"]. "</td> <td class='editClass'>". $row["mon"]."</td> <td class='editClass'>".$row["tue"]."</td> <td class='editClass'>".$row["wed"]."</td> <td class='editClass'>".$row["thurs"]."</td> <td class='editClass'>".$row["fri"]."</td> <td class='editClass'>".$row["week_total"]."</td> <td class='editClass'>".$row["last_four"]."</td> <td class='editClass'>".$row["section"]."</td></tr>";
      
    }echo "</table>";
    
    } else {
    echo "0 results";
    }


    }else {
    
    }
        $db->close();
?>


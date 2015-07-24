<head>
  <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
  <style>
  body{
margin:0;
padding:0;
background-color:#F7F6F6;
} 
  header{
width:100%;
height: 70px;
background-color:#629C44;
transition:0.5s;
}
.headIcon{
width:auto;
height:70px;
position:absolute;
z-index:2;
}
.greenPatch{
background-color:#92D36E;
width:180px;
height:70px;
}
.navBar{
margin-left:140px;
margin-top:-55px;
font-size:30px;
color:#92D36E;
display:inline-block;
}
      .viewTimeTable {
    border-collapse:collapse;
        text-align:center;
        width:100%;
        font-family: 'Source Sans Pro', sans-serif;
}


tr.editClass:nth-child(odd){
    padding: 10px 10px 10px 5px;
    border-collapse:collapse;
    background-color:#EBFFD6;
    border-bottom:thin solid;
    border-color:#F0F0F0;

}
td.editClass{
        border-right:thin solid;
        border-color:#F0F0F0;
}
tr.editClass:nth-child(even){
    padding: 10px 10px 10px 5px;
    border-collapse:collapse;
    background-color:#F7FFEF;
         border-bottom:thin solid;
        border-color:#F0F0F0

}
td{
font-family: 'Droid Sans', sans-serif;
}
     
      th.editClass {
font-family: 'Cabin', sans-serif;
    background-color: white;
        border-collapse: collapse;
        border-bottom:thin solid;
        border-color:lightgrey;
            padding: 10px 10px 0px 5px;
}
h1{
    font-family: 'Montserrat', sans-serif;
}
  </style>
</head>
 <header>
	<section class="greenPatch"><a href="index.html"><img class="headIcon" src="tampa-bay.png"></a></section>
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Droid+Sans|Cabin|Montserrat' rel='stylesheet' type='text/css'>
<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    </header>
<?php
date_default_timezone_set('America/New_York');

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
   # echo "Connected successfully (".$db->host_info.")"."<br>";
   echo "<h1>View Student Times</h1>";
    
    $sql = "SELECT sID, last_name, first_name, mon, tue, wed, tue, thurs, fri, week_total, last_four, section FROM student_hours";
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
echo "<script>
$(document).ready(function() {
  $( '#download' ).click(function() {
  alert( 'Handler for .click() called.' );
});

)};
</script>";
if(isset($_GET['download'])){
   ob_clean();
   $file="timesheet_".date("m/d").".xls";
    header("Content-type: application/vnd.ms-excel"); 
    header("Content-Disposition: attachment; filename=$file"); 
    echo "<table class='viewTimeTable' id='viewTimeTable'>"."<tr><th class='editClass'>sID</th><th class='editClass'>Last Name </th><th class='editClass'> First Name </th><th class='editClass'> Mon </th> <th class='editClass'> Tue </th> <th class='editClass'> Wed </th> <th class='editClass'> Thurs </th> <th class='editClass'> Fri </th> <th class='editClass'> Week Total </th> <th class='editClass'> Last Four </th> <th class='editClass'> Section </th></tr>".$extractedTable."</table>";
        // $file="timesheet_".date("m/d").".xls";
        // $tableExport="<table class='viewTimeTable' id='viewTimeTable'>".$extractedTable."</table>";
        // header("Content-type: application/vnd.ms-excel");
        // header("Content-Disposition: attachment; filename=$file");
}else {
    
}
    $db->close();
    

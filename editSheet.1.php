<?php 
include 'header.html';


    ?>
<?php
    //Set Timezone
    date_default_timezone_set('America/New_York');
    //Server connection
$dsn = "pgsql:"
    . "host=ec2-107-21-125-143.compute-1.amazonaws.com;"
    . "dbname=deadm3k5bm4tsv;"
    . "user=dvkcevygfoffdp;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=T00C1WPiv8B2-EdRQkSTl_WIkT";
 
$db = new PDO($dsn);
?>
<html>
 <head>
  <title>Student Times</title>
 </head>
 <body>
          <h1> View Student Times</h1>
  <table class='viewTimeTable' id='viewTimeTable'>
   <thead>
    <tr>
     <th class='editClass'>SID</th>
     <th class='editClass'>Last Name</th>
     <th class='editClass'>First Name</th>
     <th class='editClass'>Mon</th>
     <th class='editClass'>Tue</th>
     <th class='editClass'>Wed</th>
     <th class='editClass'>Thurs</th>
     <th class='editClass'>Fri</th>
     <th class='editClass'>Week Total</th>
     <th class='editClass'>Last Four</th>
     <th class='editClass'>Section Name</th>
    </tr>
   </thead>
   <tbody>
<?php
$query = "SELECT * FROM student_hours";
$result = $db->query($query);
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr class='editClass'>";
    echo "<td>".$row["sid"]."</td>";
    echo "<td>".$row["last_name"]."</td>";
    echo "<td>".$row["first_name"]."</td>";
    echo "<td>".$row["mon"]."</td>";
    echo "<td>".$row["tue"]."</td>";
    echo "<td>".$row["wed"]."</td>";
    echo "<td>".$row["thurs"]."</td>";
    echo "<td>".$row["fri"]."</td>";
    echo "<td>".$row["week_total"]."</td>";
    echo "<td>".$row["last_four"]."</td>";
    echo "<td>".$row["section"]."</td>";
    echo "</tr>";
    $extractedTable= "<tr class='editClass'>"."<td>".$row["sid"]."</td>"."<td>".$row["last_name"]."</td>"."<td>".$row["first_name"]."</td>"."<td>".$row["mon"]."</td>"."<td>".$row["tue"]."</td>".
    "<td>".$row["wed"]."</td>"."<td>".$row["thurs"]."</td>". "<td>".$row["fri"]."</td>". "<td>".$row["week_total"]."</td>"."<td>".$row["last_four"]."</td>"."<td>".$row["section"]."</td>"."</tr>";
}
echo "</table>";
$downloadButton = "<form action='' method='GET'>
    <input type='submit' name='download' class='download' id='download' value='Download Timesheet'>
    </form>";
    
    echo $downloadButton;
    
    
    if(isset($_GET['download'])){
   
  
        ob_clean();
        $file="timesheet_".date("m/d").".xls";
        $tableExport="<table class='viewTimeTable' id='viewTimeTable'>".$extractedTable."</table>";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$file");

$query = "SELECT * FROM student_hours";
    //Grabs the result of the query
    $result = $db->query($query);

    // output data of each row
    echo "<table class='viewTimeTable' id='viewTimeTable'>";
    echo "<tr><th class='editClass'>sID</th><th class='editClass'>Last Name </th><th class='editClass'> First Name </th><th class='editClass'> Mon </th> <th class='editClass'> Tue </th> <th class='editClass'> Wed </th> <th class='editClass'> Thurs </th> <th class='editClass'> Fri </th> <th class='editClass'> Week Total </th> <th class='editClass'> Last Four </th> <th class='editClass'> Section </th></tr>";
   while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr class='editClass'>"."<td>".$row["sid"]."</td>"."<td>".$row["last_name"]."</td>"."<td>".$row["first_name"]."</td>"."<td>".$row["mon"]."</td>"."<td>".$row["tue"]."</td>".
    "<td>".$row["wed"]."</td>"."<td>".$row["thurs"]."</td>". "<td>".$row["fri"]."</td>". "<td>".$row["week_total"]."</td>"."<td>".$row["last_four"]."</td>"."<td>".$row["section"]."</td>"."</tr>";
    
    }echo "</table>";
    
}
$result->closeCursor();
?>
   </tbody>
  </table>
 </body>
</html>


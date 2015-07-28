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
     <th class='editClass'>Last Name</th>
     <th class='editClass'>First Name</th>
     <th class='editClass'>Section Name</th>
     <th class='editClass'>SID</th>
     <th class='editClass'>Gender</th>
    </tr>
   </thead>
   <tbody>
<?php
$query = "SELECT * FROM students";
$result = $db->query($query);
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
   echo "<tr class='editClass'>";
   echo "<td>".$row["first_name"]."</td>";
   echo "<td>".$row["last_name"]."</td>";
   echo "<td>".$row["section_type"]."</td>";
   echo "<td>".$row["sid"]."</td>";
   echo "<td>".$row["gender"]."</td>";
   echo "</tr>";
    
}
$result->closeCursor();
?>
   </tbody>
  </table>
 </body>
</html>


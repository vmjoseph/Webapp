<head>
    <style>
      td:nth-child(odd){
          background-color:green;
      }
      th {
    background: #92D36E;
        border-collapse: collapse;
}
    </style>
</head>
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
    echo "Connected successfully (".$db->host_info.")"."<br>";
    
    $sql = "SELECT sID, last_name, first_name, mon, tue, wed, tue, thurs, fri, week_total, last_four, section FROM student_hours";
    $result = $db->query($sql);
    
    if ($result->num_rows > 0) {
    // output data of each row
    echo "<table cellspacing='0' cellpadding='0'>";
 echo "<tr><th>sID</th><th>Last Name </th><th> First Name </th><th> Mon </th><th> Tue </th><th> Wed </th><th> Thurs </th><th> Fri </th><th> Week Total </th><th> Last Four </th><th> Section </th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>". $row["sId"]. "</td><td>" . $row["last_name"]. "</td><td> " . $row["first_name"]. "</td><td>". $row["mon"]."</td><td>".$row["tue"]."</td><td>".$row["wed"]."</td><td>".$row["thurs"]."</td><td>".$row["fri"]."</td><td>".$row["week_total"]."</td><td>".$row["last_four"]."</td><td>".$row["section"]."</td></tr>";
    }echo "</table>";
    } else {
    echo "0 results";
    }
    $db->close();
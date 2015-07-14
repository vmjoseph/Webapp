<?php
    // A simple PHP script demonstrating how to connect to MySQL.
    // Press the 'Run' button on the top to start the web server,
    // then click the URL that is emitted to the Output tab of the console.

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
    echo "Connected successfully (".$db->host_info.")";
    
    $sql= "CREATE table testTable";
    
    $sqlTitle="testTable";
    
    if ($db->query ($sql)==TRUE){
        echo "<br>The table ,". $sqlTitle. ", has been created successfully.";
    } else {
        echo "<br>Sorry, the database encountered an error: <br>". $db->error;
    }
?>
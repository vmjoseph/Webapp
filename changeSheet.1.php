<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
    <?php include 'header.html';
 //   include 'pullOutmenu.html';?>
    <?php echo "<form action='' method='POST'>";?>
<?php
//variables to hold connection requirements
    $dsn = "pgsql:"
    . "host=ec2-107-21-125-143.compute-1.amazonaws.com;"
    . "dbname=deadm3k5bm4tsv;"
    . "user=dvkcevygfoffdp;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=T00C1WPiv8B2-EdRQkSTl_WIkT";
    // Create connection
    $db = new PDO($dsn);
    
    // Check connection
    $dbconn = pg_connect("host=ec2-107-21-125-143.compute-1.amazonaws.com dbname=deadm3k5bm4tsv user=dvkcevygfoffdp password=T00C1WPiv8B2-EdRQkSTl_WIkT") or die
    ('Could not connect: ' . pg_last_error());
    
    //Dispalys message based on connection
    if ($dbconn->pg_last_error){
        echo "<br> Sorry, unable to connect:".pg_last_error;
    } else {
       // echo "Connected securely.";
    }

        //Gets Full Name from select HTML tags
        $fullName=$_POST['studentNames'];
        //gets Last name from HTML tags
        $lastName=substr($fullName, strpos($fullName, ",") + 1);  
        //get firstname from select html tags
        $firstName=substr($fullName, 0, strpos($fullName, ','));
   
   //Header
    echo "<h1> Edit Timesheets </h1>";
    
        // sql statement that retrieves all data from student_hours table
        $query ="SELECT sID, last_name, first_name, mon, tue, wed, tue, thurs, fri, week_total, last_four, section FROM student_hours;";
        $result = $db->query($query);
        
    // output data of each row as select option
            echo "<select name='studentNames' id='studentNames' onchange='chooseProfile()'>";
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=".$row["first_name"]. ",". $row["last_name"].">" .$row["last_name"].", ".$row["first_name"]. "</option>"; 
                
                }
                    echo "</select><br>";
    
    
    //first name $lastName=substr($fullName, strpos($fullName, ",") + 1);  
    // last name $firstName=substr($fullName, 0, strpos($fullName, ','));
    echo "<script>
            function chooseProfile(){
            var names= document.getElementById('studentNames');
            var nameTrue=names.options[names.selectedIndex].text;
            var nameFirst=nameTrue.substr(nameTrue.indexOf(',') + 1);
            var nameLast=nameTrue.slice(0, nameTrue.indexOf(','));
            console.log(nameFirst);
            console.log(nameLast);
    
         }
            </script>";
    
    #Grab Mon Hours from Database where the first name matches the select option dropdown
        $queryMon = "SELECT mon FROM student_hours WHERE last_name='$lastName' AND first_name='$firstName' ";
        $resultMon = $db->query($queryMon);
    
    
    // output monday times of selected student
        while ($row = $resultMon->fetch(PDO::FETCH_ASSOC)) {
            //grabs the hours already stored in database for monday
        $savedMonHours=$row["mon"];
        }
        
    
    #Grab Tue Hours from Database 
        $queryTue = "SELECT tue FROM student_hours WHERE last_name='$lastName' AND first_name='$firstName' ";
        $resultTue = $db->query($queryTue);
    
    
        while ($row = $resultTue->fetch(PDO::FETCH_ASSOC)) {
            //grabs the hours already stored in database for tuesday
        $savedTueHours=$row["tue"];
        }
    
    
    #Grab Wed Hours
        $queryWed = "SELECT wed FROM student_hours WHERE last_name='$lastName' AND first_name='$firstName' ";
        $resultWed = $db->query($queryWed);
    
    
    // output data of each row
        while ($row = $resultWed->fetch(PDO::FETCH_ASSOC)) {
            //grabs the hours already stored in database for wednesday
        $savedWedHours=$row["wed"];
        }
        
    
    #Grab Thurs Hours
        $queryThurs = "SELECT thurs FROM student_hours WHERE last_name='$lastName' AND first_name='$firstName' ";
        $resultThurs = $db->query($queryThurs);
        
   // output data of each row
        while ($row = $resultThurs->fetch(PDO::FETCH_ASSOC)) {
            //grabs the hours already stored in database for thursday
        $savedThursHours=$row["thurs"];
        }
    
    
    #Grab Fri Hours
        $queryFri = "SELECT fri FROM student_hours WHERE last_name='$lastName' AND first_name='$firstName' ";
        $resultFri = $db->query($queryFri);
    
   // output data of each row
        while ($row = $resultFri->fetch(PDO::FETCH_ASSOC)) {
            //grabs the hours already stored in the database for friday
        $savedFriHours=$row["fri"];
        }
    
    
#Time Calculations:
    
    #Monday Time Sheet
    //Sets the SQL statement so that if there are muliple entries, the statement is adjusted as such.
        $monCalc= "mon='$monTime',";
    //Monday 
        $mTin=strtotime( $_POST['mTimein']);
    //Monday Time Out
        $mTout=strtotime( $_POST['mTimeout']);
    //Takes difference of times
        $allMonTime=$mTout-$mTin;
    //Converts Monday Time to Date format of Hours: Minutes
        $monTimeConvert=date("H:i",$allMonTime);
    //Testing Monday hours
        echo "<script> console.log('all monday time is: $savedMonHours');</script>";  
        $monTime= date("H:i",$mTout-$mTin);
            if ($monTime=== "00:00"){
                //if the user does not enter a time for monday, the monday calcualtion and sql statement will be empty
                $monCalc= NULL;
                $monTime= NULL;
            
            } else{
                //if the user has entered a time for monday, the following happens
                    if (!empty($tueCalc)){
                        //if tuesday has a user entered/ databse stored time, monday's sql statement will have a comma
                      $monCalc= "mon='$monTime',";
                    } else {
                        // if tuesday does not have a database stored time or a user entered time, monday's sql statement will not have a comma
                    $monCalc= "mon='$monTime'";
                    }
            }
            
            if(empty($savedMonHours)){
                //if there is no saved time for monday, have the user entered time become the saved hours
            $savedMonHours=$monTime;
            } else{
                //if there is a saved time in the database , use it
                $savedMonHours=$savedMonHours;
            }
            // create a time slot entry for monday
        echo "<table class='weekDays'name='mondayTimes'>
        <tr><th align='center' colspan='2'>Monday</th></tr>
        <tr><td align='center'>Time In</td><td align='center'>Time Out</td></tr>
        <tr><td><input name='mTimein' id='mOut'type='time'></td><td><input name='mTimeout' id='mOut'type='time'></td></tr>";
        
    #Tuesday Time Sheet
    //Sets the SQL statement so that if there are muliple entries, the statement is adjusted as such.
        $tueCalc= "tue='$tueTime',";
    //Tuesday Time In 
        $tTin= strtotime($_POST['tTimein']);
    //Tuesday Time Out
        $tTout= strtotime($_POST['tTimeout']);
    //Converts Monday Time to Date format of Hours: Minutes
        $tueTime= date("H:i",$tTout-$tTin);
    //Takes difference of times
        $allTuesTime=$tTout-$tTin;
    //Converts Monday Time to Date format of Hours: Minutes
        $tuesTimeConvert=date("H:i", $allTuesTime);
        echo "<script> console.log('all tue time is: $savedTueHours');</script>";
        
        if ($tueTime=== "00:00"){
        $tueCalc= NULL;
        $tueTime= NULL;
        
        }else{
        if (!empty($wedCalc)){
          $tueCalc= "tue='$tueTime',";
        } else {
        $tueCalc= "tue='$tueTime'";
        }
        }
        if(empty($savedTueHours)){
        $savedTueHours=$tueTime;
        }
        else{
        $savedTueHours=$savedTueHours;
        }
        echo "<table class='weekDays'name='tuesdayTimes'>
        <tr><th align='center' colspan='2'>Tuesday</th></tr>
        <tr><td align='center'>Time In</td><td align='center'>Time Out</td></tr>
        <tr><td><input id='tIn'name='tTimein' type='time'></td><td><input name='tTimeout'id='tOut' type='time'></td></tr>";
    
    #Wednesday Time Sheet
        $wedCalc= "wed='$wedTime',";
        $wTin= strtotime($_POST['wTimein']);
        $wTout= strtotime($_POST['wTimeout']);
        $wedTime= date("H:i",$wTout-$wTin);
        $allWedTime=$wTout-$wTin;
        $wedsTimeConvert=date("H:i", $allWedTime);
        echo "<script> console.log('all wed time is: $savedWedHours');</script>";
        if ($wedTime=== "00:00"){
        $wedCalc= NULL;
        $wedTime= NULL;
        
        }else{
        if (!empty($thursCalc)){
          $wedCalc= "wed='$wedTime',";
        } else {
        $wedCalc= "wed='$wedTime'";
        }
        }
        
        if(empty($savedWedHours)){
        $savedWedHours=$wedTime;
        }
        else{
        $savedWedHours=$savedWedHours;
        }
        echo "<table class='weekDays'name='wednesdayTimes'>
        <tr><th align='center' colspan='2'>Wednesday</th></tr>
        <tr><td align='center'>Time In</td><td align='center'>Time Out</td></tr>
        <tr><td><input id='wIn'name='wTimein' type='time'></td><td><input name='wTimeout' id='wOut' type='time'></td></tr>";
        // echo "<script> console.log('all wed time is: $savedWedHours');</script>";
    #Thursday Time Sheet
    $thursCalc= "thurs='$thursTime',";
    $thTin=strtotime($_POST['thTimein']);
    $thTout= strtotime($_POST['thTimeout']);
    $thursTime= date("H:i",$thTout-$thTin);
    $allThursTime=$thTout-$thTin;
    $thursTimeConvert=date("H:i", $allThursTime);
    echo "<script> console.log('all thurs time is: $savedThursHours');</script>";
    if ($thursTime=== "00:00"){
    $thursCalc= NULL;
    $thursTime= NULL;
    
    }else{
    if (!empty($friCalc)){
      $thursCalc= "thurs='$thursTime'";
    } else {
    $thursCalc= "thurs='$thursTime'";
    }
    }
    if(empty($savedThursHours)){
    $savedThursHours=$thursTime;
    }
    else{
    $savedThursHours=$savedThursHours;
    }
    echo "<table class='weekDays'name='thursdayTimes'>
    <tr><th align='center' colspan='2'>Thursday</th></tr>
    <tr><td align='center'>Time In</td><td align='center'>Time Out</td></tr>
    <tr><td><input name='thTimein'id='thIn' type='time'></td><td><input name='thTimeout'id='thOut' type='time'></td></tr>";
    #Friday Time Sheet
    $friCalc= "fri='$friTime'";
    $fTin=  strtotime($_POST['fTimein']);
    $fTout=  strtotime($_POST['fTimeout']);
    $friTime= date("H:i",$fTout-$fTin);
    $allFriTime=$fTout-$fTin;
    $friTimeConvert=date("H:i", $allFriTime);
    echo "<script> console.log('all fri time is: $savedFriHours');</script>";
    if ($friTime=== "00:00"){
    $friCalc= NULL;
    $friTime= NULL;
    
    }else{
    
    $friCalc= "fri='$friTime'";
    }
    if(empty($savedFriHours)){
    $savedFriHours=$friTime;
    }
    else{
    $savedFriHours=$savedFriHours;
    }
    #something wrong with thurs/wed
    #$draftHours=strtotime($savedMonHours)+strtotime($savedTueHours)+strtotime($savedWedHours)+strtotime($savedThursHours)+strtotime($savedFriHours);
    
    
    
    echo "<Script> console.log('total hours are:$finalHours ');</script>";
    echo "<table class='weekDays'name='fridayTimes'>
    <tr><th align='center' colspan='2'>Friday</th></tr>
    <tr><td align='center'>Time In</td><td align='center'>Time Out</td></tr>
    <tr><td><input name='fTimein'id='fIn' type='time'></td><td><input name='fTimeout'id='fOut' type='time'></td></tr>
    </table>";
    echo "<input type='submit' class='submitHours' name='submit' value='Submit Hours' onclick='location.reload();'></form>";
    
    if(isset($_POST['submit'])) 
    {
    echo "<script> console.log('$lastName');</script>";
    
    #strtotime($savedMonHours)+strtotime($savedTueHours)+strtotime($savedWedHours);
    //Need to remove date format, as date only goes up to 24 hrs. Convert time into decimal 
    function decimalHours($time)
    {
    $hms = explode(":", $time);
    return ($hms[0] + ($hms[1]/60) + ($hms[2]/3600));
    }
    
    $draftHours=0;
    //decimalHours($savedMonHours)+decimalHours($savedTueHours)+decimalHours($savedWedHours)+decimalHours($savedThursHours)+decimalHours($savedFriHours);
    if ($savedMonHours==!NULL){
    $draftHours+=decimalHours($savedMonHours);
    }
    if ($savedTueHours==!NULL){
    $draftHours+=decimalHours($savedTueHours);
    }
    if ($savedWedHours==!NULL){
    $draftHours+=decimalHours($savedWedHours);
    }
    if ($savedThursHours==!NULL){
    $draftHours+=decimalHours($savedThursHours);
    }
    if ($savedFriHours==!NULL){
    $draftHours+=decimalHours($savedFriHours);
    }
    $finalHours=number_format($draftHours,2, '.', '');
    #SET mon='$monTime', week_total='$finalHours'
    $hoursResult= pg_query( $dbconn, "UPDATE student_hours SET $monCalc $tueCalc $wedCalc $thursCalc $friCalc WHERE last_name='$lastName' AND first_name='$firstName'");
    
    // if (!$result) {
    //  echo "<div class='successCheck'>New student was not created!<br> The following error has occured:"."Error: ". $sql2 . " <br> ".$result.($db)."!</div>";
    // exit;
    // }else{
    
    // echo "<div class='successCheck'>New student created successfully!<div class='return'>Click Here to Return <a class='noDecoration2'href='index.html'><img src='return.png'></a></div></div>";
    
    // <form action='changeSheet.php'><input type='submit' class='resfresh' name='submit2' value='Click here to refresh the hours'></form>
    if (!$hoursResult){
    echo "Error: No Hours Entered, please try again<br> ";
    
    exit;
    if(isset($_POST['submit2'])) {
    
     window.reload();
    } else {
    
    }
    
    } else {
    echo "Records Updated successfully<img class='reload' onclick='location.reload();' width='20px' height='auto' src='http://png-5.findicons.com/files/icons/2152/snowish/128/gtk_refresh.png'>";
    echo "<div id='errorText'></div>";
    // echo "Error: " . $hourSql . "<br>" . mysqli_error($db);
    
    // echo "Error: ". $hourSql . " <br> ".mysqli_error($db);
    }
    echo "<div id='errorText'></div><table class='previewHours'>";
    echo "<tr><th colspan='2'>Hours for ". $firstName. ":</th></tr>";
    
    echo "<tr><td>Monday:</td><td> ".$savedMonHours."</td></tr><!--";
    echo "--><tr><td>Tuesday:</td><td> ".$savedTueHours."</td></tr><!--";
    echo "--><tr><td>Wednesday:</td><td>".$savedWedHours."</td></tr><!--";
    echo "--><tr><td>Thursday:</td><td> ".$savedThursHours."</td></tr><!--";
    echo "--><tr><td>Friday:</td><td> ".$savedFriHours."</td></tr>";
    $hoursResult2=pg_query( $dbconn, "UPDATE student_hours SET week_total='$finalHours' WHERE last_name='$lastName' AND first_name='$firstName' ;");
    
    if (!$hoursResult2){
    // echo "Total Updated successfully";
    echo "Error: " . $hoursResult2 . "<br>" .$result.($db);
    exit;
    } else {
    
    echo "<tr><td>Total Hours Updated:</td><td>".$finalHours."</td></tr>";
    // echo "Error: ". $hourSql . " <br> ".mysqli_error($db);
    }
    echo "</table>";
    }
    
    else               
    {
    // Display the Form and the Submit Button
    }
    pg_close($dbconn);
?>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<?php include 'header.html';?>
<?php echo "<form action='changeSheet.php' method='POST'>";
#<input name='dateSelector' type='week'>
?>
<?php
//variables to hold connection requirements
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
        // echo "Connected successfully (".$db->host_info.")"."<br>";
    //Gets Full Name from select HTML tags
    $fullName=$_POST['studentNames'];
    //gets Last name from HTML tags
    $lastName=substr($fullName, strpos($fullName, ",") + 1);  
        //get firstname from select html tags
    $firstName=substr($fullName, 0, strpos($fullName, ','));
    // echo "<div class='info2'>a</div> ";

    // sql statement that retrieves all data from student_hours table
    $sql = "SELECT sID, last_name, first_name, mon, tue, wed, tue, thurs, fri, week_total, last_four, section FROM student_hours";
    $result = $db->query($sql);
    
    // if ($result->num_rows > 0) {
    // // output data of each row as select option
    // echo "<select name='studentNames'>";
    // while($row = $result->fetch_assoc()) {
    //   echo "<option value=".$row["first_name"].">" .$row["last_name"].", ".$row["first_name"]. "</option>"; 
       
    // }echo "</select><br>";
    // } else {
    //     //to display if there are no rows in the database
   
    // }
    // echo "<div id='profileHolder'><div id='innerProfileHolder'><span id='profileIconHolder'></span><span id='info2'>Hi! I'm where the student profiles will appear</span></div></div>";
    
     if ($result->num_rows > 0) {
    // output data of each row as select option
    echo "<select name='studentNames' onclick='chooseProfile()'>";
    while($row = $result->fetch_assoc()) {
       echo "<option value=".$row["first_name"]. ",". $row["last_name"].">" .$row["last_name"].", ".$row["first_name"]. "</option>"; 
       
    }echo "</select><br>";
    } else {
        //to display if there are no rows in the database
   
    }
//   echo"<script>
//           function chooseProfile(){
//               document.getElementById('profileHolder').style.backgroundColor='red';
//               var x=document.getElementById('info2').innerHTML='$firstName'+ ' ' + '$lastName';
//               console.log('red');
//             }
//       </script>";

    #Grab Mon Hours from Database where the first name matches the select option dropdown
    
    $sqlMon = "SELECT mon FROM student_hours WHERE last_name='$lastName' AND first_name='$firstName' ";
    $resultMon = $db->query($sqlMon);
    
    if ($resultMon->num_rows > 0) {
    // output monday times of selected student
    while($row = $resultMon->fetch_assoc()) {
      $savedMonHours=$row["mon"];
    }
    } else {
   
    }
    
    #Grab Tue Hours from Database 
    $sqlTue = "SELECT tue FROM student_hours WHERE last_name='$lastName' AND first_name='$firstName' ";
    $resultTue = $db->query($sqlTue);
    
    if ($resultTue->num_rows > 0) {
    // output data of each row
    while($row = $resultTue->fetch_assoc()) {
      $savedTueHours=$row["tue"];
    }
    } else {
   
    }
    
    #Grab Wed Hours
     $sqlWed = "SELECT wed FROM student_hours WHERE last_name='$lastName' AND first_name='$firstName' ";
    $resultWed = $db->query($sqlWed);
    
    if ($resultWed->num_rows > 0) {
    // output data of each row
    while($row = $resultWed->fetch_assoc()) {
      $savedWedHours=$row["wed"];
    }
    } else {
         
    }
    
    #Grab Thurs Hours
     $sqlThurs = "SELECT thurs FROM student_hours WHERE last_name='$lastName' AND first_name='$firstName' ";
    $resultThurs = $db->query($sqlThurs);
    
    if ($resultThurs->num_rows > 0) {
    // output data of each row
    while($row = $resultThurs->fetch_assoc()) {
      $savedThursHours=$row["thurs"];
    }
    } else {
   
    }
    
    #Grab Fri Hours
         $sqlFri = "SELECT fri FROM student_hours WHERE last_name='$lastName' AND first_name='$firstName' ";
    $resultFri = $db->query($sqlFri);
    
    if ($resultThurs->num_rows > 0) {
    // output data of each row
    while($row = $resultFri->fetch_assoc()) {
      $savedFriHours=$row["fri"];
         }
    } else {
   
    }
    
#Time Calculations:

#Monday Time Sheet

#SET mon='$monTime',
$monCalc= "mon='$monTime',";
$mTin=strtotime( $_POST['mTimein']);
$mTout=strtotime( $_POST['mTimeout']);
$allMonTime=$mTout-$mTin;
$monTimeConvert=date("H:i",$allMonTime);
echo "<script> console.log('all monday time is: $savedMonHours');</script>";  
$monTime= date("H:i",$mTout-$mTin);
    if ($monTime=== "00:00"){
        $monCalc= NULL;
        $monTime= NULL;
        
 }else{
        if (!empty($tueCalc)){
                  $monCalc= "mon='$monTime',";
        } else {
    $monCalc= "mon='$monTime'";
                }
    }
    
if(empty($savedMonHours)){
    $savedMonHours=$monTime;
}
else{
    $savedMonHours=$savedMonHours;
}
echo "<table class='weekDays'name='mondayTimes'>
<tr><th align='center' colspan='2'>Monday</th></tr>
<tr><td align='center'>Time In</td><td align='center'>Time Out</td></tr>
<tr><td><input name='mTimein' id='mOut'type='time'></td><td><input name='mTimeout' id='mOut'type='time'></td></tr>";
#Tuesday Time Sheet

$tueCalc= "tue='$tueTime',";
$tTin= strtotime($_POST['tTimein']);
$tTout= strtotime($_POST['tTimeout']);
$tueTime= date("H:i",$tTout-$tTin);
$allTuesTime=$tTout-$tTin;
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
$hourSql="UPDATE student_hours SET $monCalc $tueCalc $wedCalc $thursCalc $friCalc WHERE last_name='$lastName' AND first_name='$firstName' ";
// <form action='changeSheet.php'><input type='submit' class='resfresh' name='submit2' value='Click here to refresh the hours'></form>
if (mysqli_query($db, $hourSql)){
        echo "Records Updated successfully<img class='reload' onclick='location.reload();' width='20px' height='auto' src='http://png-5.findicons.com/files/icons/2152/snowish/128/gtk_refresh.png'>";
        echo "<div id='errorText'></div>";
            if(isset($_POST['submit2'])) {
            
                 window.reload();
            } else {
            
                }
 
    } else {
        echo "Error: No Hours Entered, please try again<br> ";
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

    $insertHours2="UPDATE student_hours SET week_total='$finalHours' WHERE last_name='$lastName' AND first_name='$firstName' ";
if (mysqli_query($db, $insertHours2)){
        // echo "Total Updated successfully";
        echo "<tr><td>Total Hours Updated:</td><td>".$finalHours."</td></tr>";
    } else {
    echo "Error: " . $insertHours2 . "<br>" . mysqli_error($db);

        // echo "Error: ". $hourSql . " <br> ".mysqli_error($db);
    }
     echo "</table>";
}

else               
{
    // Display the Form and the Submit Button
}

    $db->close();
?>
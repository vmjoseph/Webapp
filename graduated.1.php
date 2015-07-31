<?php
$dsn = "pgsql:"
    . "host=ec2-107-21-125-143.compute-1.amazonaws.com;"
    . "dbname=deadm3k5bm4tsv;"
    . "user=dvkcevygfoffdp;"
    . "port=5432;"
    . "sslmode=require;"
    . "password=T00C1WPiv8B2-EdRQkSTl_WIkT";
 


    // Create connection
    $db =  new PDO($dsn);

    // Check connection
$dbconn = pg_connect("host=ec2-107-21-125-143.compute-1.amazonaws.com dbname=deadm3k5bm4tsv user=dvkcevygfoffdp password=T00C1WPiv8B2-EdRQkSTl_WIkT")


        or die('Could not connect: ' . pg_last_error());
        
    if ($dbconn->pg_last_error){
        echo "<br> Sorry, unable to connect:".pg_last_error;
    } else {
       // echo "Connected securely.";
    }
    ?><head>
<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
<script src="http://fancyapps.com/fancybox/source/jquery.fancybox.js"></script>
<link rel="stylesheet" type="text/css" href="http://fancyapps.com/fancybox/source/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="styles.css">
<link href='http://fonts.googleapis.com/css?family=Lato|Quattrocento+Sans|Oxygen|Hind|Raleway' rel='stylesheet' type='text/css'>
<script src="career.js"></script>
</head>
<?php include("header.html");?>
<body onload="set_style_from_cookie()">
<h1> Graduated Students</h1>
<p>Search for Students:<input type="search" id="searchRecords" name="searchRecords"><button type="button" id="searchButton"
onclick="searchStudents()">Search</button>
<button type="button" onclick="hideStudents()">Hide All</button><button type="button" onclick="showStudents()">Show All</button></p>

    <!--<section class="gradSection">-->
    <!--    <img class="profileIcon2" src="http://brandonmathis.com/projects/fancy-avatars/demo/images/avatar_male_dark_on_clear_200x200.png">-->
    <!--    <div class="name">Wright, Raedon</div>-->
    <!--    <span class="date">9-Jul-15</span>-->
    <!--        <span class="info">-->
    <!--            <a href="allcertificates.split\Wright, Raedon Certificate.pdf" class="certLink">Certificate</a>|-->
    <!--            <a href="Certiport Reports\Certiport Reports\Wolf, Jake Certiport Report.pdf" class="infoLink">Info</a>-->
    <!--        </span>-->
    <!--</section>-->
    <script>
    var toggled;
       $(document).ready(function(){
            
            $("button#addGrad").click(function(){
                toggled=true;
                $(".gradForm").toggle();
                $("button#addGrad").html("Add a Grad");
                console.log(toggled);
            });
                   
           
        });
    </script>
    <button id="addGrad">Add a Grad</button>
    <form class="gradForm" action=" " method="POST">
        <table border=1>
        <tr><td>First Name:</td><td><input type="text" value="stuff" name="firstName"></td><td>Last Name:</td>
        <td><input type="text" value="stuff" name="lastName"></td></tr>
        <tr><td colspan="4"><center>Date of Graduation:<input type="date" name="gradDate"></td></center></tr>
        <tr><td>Result File:</td><td><input name ="result" type="file"></td> <td>Certificate</td><td><input type="file" name="pdf"></td></tr>
        <tr><td colspan="4"><center><input type="submit" name="submit" value="Add Entry"></center></td></tr>
        
        </table>
    </form>
<!--<form action="homework.php" enctype="multipart/form-data" method="POST">-->
<!--    Last Name:<br /> <input type="text" name=" name" value= " " /> <br />-->
<!--    Homework:<br /> <input type="file" name=" homework" value= " " /> <br />-->
<!--    <p><input type="submit" value="Submit Notes" name="submit"></p>-->
<!--</form>-->
</body>

<?php
$lastN=$_POST["lastName"];
$firstN= $_POST["firstName"];
$gradDate=$_POST["gradDate"];
$resultpdf=$_POST["result"];
$certificatepdf =pg_escape_string($_POST["pdf"]);

if(isset($_POST["submit"])){
    echo $certificatepdf  ;
    // $result= pg_query($dbconn,"INSERT INTO grad_students (last_name, first_name, date, result, certificate) VALUES
    // ('$lastN','$firstN','$gradDate','$resultpdf','$certificatepdf')");
    //  var_dump($result);  
    //     if (!$result) {
    //         echo "Sorry, error";
    //         exit;
    //     } else{
    //         echo  "Student was added successfully!";
            
    //     }  
  

  
    }


?>


<HTML>
<?php
if( isset($_POST['submit1'])) {
// $_FILES is the array auto filled when you upload a file and submit a form.
$userfile_name = $_FILES['file1']['name']; // file name
$userfile_tmp  = $_FILES['file1']['tmp_name']; // actual location
$userfile_size  = $_FILES['file1']['size']; // file size
$userfile_type  = $_FILES['file1']['type']; // mime type of file sent by browser. PHP doesn't check it.
$userfile_error  = $_FILES['file1']['error']; // any error!. get from here
// Content uploading.
$file_data = '';
if ( !empty($userfile_tmp))
{
// We encode the data just to make it more database friendly
$file_data = base64_encode(@fread(fopen($userfile_tmp, 'r'), filesize($userfile_tmp) ) );
}
switch (true)
{
// Check error if any
case ($userfile_error == UPLOAD_ERR_NO_FILE):
case empty($file_data):
echo 'You must select a document to upload before you can save this page.';
exit;
break;
case ($userfile_error == UPLOAD_ERR_INI_SIZE):
case ($userfile_error == UPLOAD_ERR_FORM_SIZE):
echo 'The document you have attempted to upload is too large.';
break;
case ($userfile_error == UPLOAD_ERR_PARTIAL):
echo 'An error occured while trying to recieve the file. Please try again.';
break;
}
if( !empty($userfile_tmp))
{
// only MS office and text file is accepted.
if( !(($userfile_type=="application/msword") || ($userfile_type=="text/plain")) )
{echo 'Your File Type is:'. $userfile_type;
echo '<br>File type must be text(.txt) or msword(.doc).';
exit;
}
}
echo filesize($userfile_tmp);
}
?>
<form name="profile" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" target="_self" enctype="multipart/form-data" >
<P align ="center"><input type="hidden" name="MAX_FILE_SIZE" value="1000000">
<input type="file" name="file1" value="AttachFile" device="files" accept="text/*" tabindex=18 >
<input type="submit" name="submit1" value="Submit" />
</P>
</form>
</HTML>
<?php include("footer.html");?>
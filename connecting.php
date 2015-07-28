<?php
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
     <script>
                $(document).ready(function(){
                    $(".addStudentButton").click(function(){
                         $(".timeSheetForm").show("specialEasing");
                             $(".submitArea").show("specialEasing");
                        // Animation complete.
                    });
                    $(".escape").click(function() {
                        $(".submitArea").hide();
                         $(".timeSheetForm").closest('form').find("input[type=text], textarea").val("");
                         $(".timeSheetForm").closest('form').find("#sidNumber").val("");
                         $(".timeSheetForm").closest('form').find("select").val("");
                         $("#sectionLable").html("");
                  
                    });
                    
                    $(".editSheet").click(function(){
                         window.location = "changeSheet.php";
                    });
                    
                    $(".openSheet").click(function(){
                       window.location = "editSheet.php";
                    });
                    
                    $("#openSheet").click(function(){
                        $("#sectionSelection").val();
                            $("#sectionLable").html("hi");
                    });
                    $(".escape").click(function(){
                       $(".timeSheetForm").hide(); 
                    });
                    
                    $(".toggleTool").click(function(){
                        $(".sideSection").toggle("specialEasing", function() { });
                        //  $("#quickNavHolder").css("margin-left", "0px");
                    });
                    
                     $("#add").click(function(){
                         $(".timeSheetForm").show("specialEasing");
                         $(".submitArea").show("specialEasing");
                        });
                    $("#view").click(function(){
                        window.location.replace("editSheet.php");
                        });
                    $("#edit").click(function(){
                        window.location.replace("changeSheet.php");
   
                    }); 
                });
                
        </script>
        <script>
            function autoSelectcomplete(){
             
                var userSelect= document.getElementById("sectionSelection").value;
                switch (userSelect){
                    case "WLD":
                    document.getElementById("sectionLable").innerHTML=userSelect;
                    break;
                    case "WIA":
                    document.getElementById("sectionLable").innerHTML=userSelect;
                    break
                    case "WTP":
                    document.getElementById("sectionLable").innerHTML=userSelect;
                    break;
                default:
                document.getElementById("sectionLable").innerHTML="Please select a Section";
              }
            }
            function genderInput(){
                 var genderSelect= document.getElementById("genders").value;
                 console.log(genderSelect);
            }
            function leadingZero(){
               var getNumber= document.getElementById("sidNumber");
                if (getNumber.value>=10){
                      getNumber.value="00"+getNumber.value;
                            console.log(getNumber);
                 }else {
                     
                getNumber.value="000"+getNumber.value;
                console.log(getNumber); 
                 }
            }
            function submitVerify(){
var nameFirst = document.getElementById("first").value.trim().length;
var nameLast = document.getElementById("last").value.trim().length;
var lastFour= document.getElementById("lastfour").value.trim().length;
var sid = document.getElementById("sidNumber").value.trim().length;
var sex = document.getElementById("genders").value;
var section = document.getElementById("sectionLable").innerHTML.length;
console.log(lastFour);
if (nameFirst===0||nameLast===0||lastFour<4||section==0||sid<4){
        alert('Please fill in the missing values');
        if(nameLast==0){
            document.getElementById("lastCorrecter").style.opacity = "1.0";
        } else {
            document.getElementById("lastCorrecter").style.opacity = "0";
        }
         if(nameFirst==0){
            document.getElementById("firstCorrecter").style.opacity="1.0";
        } else {
             document.getElementById("firstCorrecter").style.opacity="0";
        }
        if(lastFour<4){
            document.getElementById("lastFourCorrecter").style.opacity="1.0";
        } else {
             document.getElementById("lastFourCorrecter").style.opacity="0";
        }
        if(section==0){
            document.getElementById("sectionCorrecter").style.opacity="1.0";
        } else {
             document.getElementById("sectionCorrecter").style.opacity="0";
        }
         if(sid<4){
            document.getElementById("sidCorrecter").style.opacity="1.0";
        } else {
             document.getElementById("sidCorrecter").style.opacity="0";
        }
window.reload();
} else {
      document.getElementById("timeSheetForm").submit();
}
          
            }
            var toggle=toggle
            function togglingMenu(){
                toggle=!toggle;
                console.log(toggle);
                var panel= document.getElementById("toggleTool");
                panel.style.margin="-338px 198px ";
                panel.style.transform="rotate(180deg)"
                if(toggle==false){
                  panel.style.margin="-338px 0px";
                  panel.style.transform="rotate(360deg)"
                }
            }
        </script>
  <title>Employees</title>
 </head>
 <body>

  <form action=" " method="POST">
     <table class="timesheetOrganizer"> 
                <tr class="addStudent"><td class="addStudent">Last Name<span id="lastCorrecter">*</span>:</td><td class="addStudent"><input type="text" id="last" name="last"></td></tr> 
                <tr class="addStudent"><td class="addStudent">First Name<span id="firstCorrecter">*</span>:</td><td class="addStudent"><input type="text" id="first" name="first"><td class="addStudent"></tr> 
                <tr class="addStudent"><td class="addStudent">Section<span id="sectionCorrecter">*</span>:</td><td class="addStudent"><select name="selectionForSection" id="sectionSelection" onchange="autoSelectcomplete()"><option value="">Select a Section</option><option value="WLD">Welding</option><option value="WIA">WIA</option><option value="WTP">WTP</option></option></select><td class="addStudent"></tr>
                <tr class="addStudent"><td class="addStudent">SID<span id="sidCorrecter">*</span>:</td><td class="addStudent"><span id="sectionLable"></span><input onchange="leadingZero()" id="sidNumber" type="number" name="sIDNumber"><td class="addStudent"></tr> 
                <tr class="addStudent"><td class="addStudent">Gender<span id="genderCorrecter">*</span>:</td><td class="addStudent"><select name="genders" onchange="genderInput()" id="genders"><option value="Male">Male</option><option value="Female">Female</option></select></td></tr> 
                <tr class="addStudent"><td class="addStudent">Last 4 (SSN)<span id="lastFourCorrecter">*</span>:</td><td class="addStudent"><input type="text" id="lastfour" name="lastfour" size="4" maxlength="4"></td></tr>       
              <tr><td colspan="2"><input name="submit" type="submit" value ="Test Submit"></td></tr>
            </table>
  </form>
<?php
$sid=$_POST['sIDNumber'];
$lastN=$_POST['last'];
$firstN=$_POST['first'];
$sectionN=$_POST['selectionForSection'];
$genderN=$_POST['genders'];
$lastfN=$_POST['lastfour'];
if (isset($_POST['submit'])){
 
$query = "INSERT INTO student_hours (sID, last_name, first_name, last_four ,section) VALUES ('$sid','$last','$first','$last4','$section')";

}
// ?>
   </tbody>
  </table>
 </body>
</html>
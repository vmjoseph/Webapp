<?php
include 'header3.html';
?>
<script>
var timer;
var startTime=10;
    function startRedirect(){
        startTime--;
var x =document.getElementById("numbers").innerHTML=startTime;
if (x === 0){
   window.location.replace("login.php");

}

    }
function startTimer(){
    timer = setInterval(startRedirect, 1000);
}
</script>
<body onload="startTimer()">
    <h1>Congrats!</h1>
    <p>Your account has been created successfully. Please <a href='login.php'>login.</a></p>
    <span id="redirectHolder">Redirecting in:..<span id="numbers">10</span></span>
</body>
<?php
include 'footer.html';
?>
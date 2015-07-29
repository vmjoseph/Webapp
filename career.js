var first;
var last;
var user;
var email;
var pass;
var pass2;
var style_cookie_name = "style" ;
var style_cookie_duration = 30 ;


// *** END OF CUSTOMISABLE SECTION ***
// You do not need to customise anything below this line

function switch_style ( css_title )
{
// You may use this script on your site free of charge provided
// you do not remove this notice or the URL below. Script from
// http://www.thesitewizard.com/javascripts/change-style-sheets.shtml
  var i, link_tag ;
  for (i = 0, link_tag = document.getElementsByTagName("link") ;
    i < link_tag.length ; i++ ) {
    if ((link_tag[i].rel.indexOf( "stylesheet" ) != -1) &&
      link_tag[i].title) {
      link_tag[i].disabled = true ;
      if (link_tag[i].title == css_title) {
        link_tag[i].disabled = false ;
      }
    }
    set_cookie( style_cookie_name, css_title,
      style_cookie_duration );
  }
}
function set_style_from_cookie()
{
  var css_title = get_cookie( style_cookie_name );
  if (css_title.length) {
    switch_style( css_title );
  }
}
function set_cookie ( cookie_name, cookie_value,
    lifespan_in_days, valid_domain )
{
    // http://www.thesitewizard.com/javascripts/cookies.shtml
    var domain_string = valid_domain ?
                       ("; domain=" + valid_domain) : '' ;
    document.cookie = cookie_name +
                       "=" + encodeURIComponent( cookie_value ) +
                       "; max-age=" + 60 * 60 *
                       24 * lifespan_in_days +
                       "; path=/" + domain_string ;
}
function get_cookie ( cookie_name )
{
    // http://www.thesitewizard.com/javascripts/cookies.shtml
    var cookie_string = document.cookie ;
    if (cookie_string.length != 0) {
        var cookie_value = cookie_string.match (
                        '(^|;)[\s]*' +
                        cookie_name +
                        '=([^;]*)' );
        return decodeURIComponent ( cookie_value[2] ) ;
    }
    return '' ;
}






function goHome(){
window.open("careerindex.html",_self)
}
function fadeUp(){
	document.getElementById("titleArea").style.opacity="1.0";
	document.getElementById("titleArea").style.marginTop="-10px";
	document.getElementById("login").style.opacity="1.0";
	document.getElementById("login").style.marginTop="-10px";
	
}

function subMit(){
	
first = document.getElementById("firstName").value.replace(/\s{2,}/g, ' ');
last = document.getElementById("lastName").value.replace(/\s{2,}/g, ' ');
user = document.getElementById("userName").value;
email = document.getElementById("emailAddress").value;
pass = document.getElementById("password1").value;
pass2 = document.getElementById("passwordConfirm").value;

firstCheck=first.length;
lastCheck=last.length;
userCheck=user.length;;
emailCheck=email.length;;
pass1Check=pass.length;;
confirmPasscheck=pass2.length;

hasFirst= false;
hasLast= false;
hasUser= false;
hasEmail= false;
hasPass1= false;
hasPass2= false;
	if (firstCheck === 0 || first=== " "){
	document.getElementById("nameNeeded").innerHTML="* Sorry, you must enter a first name";
	 }else{
		 hasFirst=true;
		 console.log("hasFirst"); console.log(hasFirst);
	 }
	 
	 if(lastCheck === 0 || last=== " "){
		 document.getElementById("nameNeeded2").innerHTML="* Sorry, you must enter a last name";
	 }else{
		 hasLast=true;
		 console.log("hasLast"); console.log(hasLast);
	 } 
	 
	 if(userCheck === 0 || user=== " "){
		 document.getElementById("nameNeeded3").innerHTML="* Sorry, you must enter a username";
	 }else{
		 hasUser=true;
		 console.log("hasUser"); console.log(hasUser);
	 }
	 
	 if(emailCheck === 0 || email=== " "){
		 document.getElementById("nameNeeded4").innerHTML="* Sorry, you must enter an email";
	 }else{
		 hasEmail=true;
		 console.log("hasEmail"); console.log(hasEmail);
	 }
	 
	 if(confirmPasscheck === 0 || pass2=== " "){
		 document.getElementById("nameNeeded6").innerHTML="* Sorry, you must enter a password";
	 }else{
		 hasPass2=true;
		 console.log("hasPass2"); console.log(hasPass2);
		 passMatch();

	 }
	 
	 if(pass1Check === 0 || pass=== " "){
		 document.getElementById("nameNeeded5").innerHTML="* Sorry, you must enter a password";
	 }else{
		 hasPass1=true;
		 console.log("hasPass1"); console.log(hasPass1);
	 } 
	 if (hasFirst=== false || hasLast=== false || hasUser=== false || hasEmail=== false || hasPass1===false || hasPass2=== false){
		alert("Sorry, you need to fill in all fields in order to continue");
	 }else {
			document.getElementById("registrationForm").submit();
			}
}
function passMatch(){
	pass1Check=pass.length;;
	pass = document.getElementById("password1").value;
	pass2 = document.getElementById("passwordConfirm").value;
	
		if (pass!=pass2){
		alert("Your passwords do not match. Please try again.");
		hasPass1=false;
		hasPass2=false;
		}else	{

				}
		if(pass1Check <8){
		document.getElementById("nameNeeded5").innerHTML="* Sorry, you must enter a password at least 8 characters";
		hasPass1=false;
		hasPass2=false;
		 }
		}
		
function hideStudents(){
	var gradSectionList = document.getElementsByClassName("gradSection");
	var i;
		for (i = 0; i < gradSectionList.length; i++) {
		gradSectionList[i].style.display = "none";
}
}
function showStudents(){
	var gradSectionList = document.getElementsByClassName("gradSection");
	var i;
		for (i = 0; i < gradSectionList.length; i++) {
		gradSectionList[i].style.display = "inline-block";
}
}

function searchStudents(){
	var search = document.getElementById("searchButton");
}
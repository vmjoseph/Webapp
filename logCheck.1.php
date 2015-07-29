<?php 
$site = "*******";   

// checks to see if id is pass to script 
If(!isset($_GET['id'])){ 
    // I was gonna put the redirect in a function but it isn't 
    // neccessary and maybe done in the next version 
    Header("Content-type: text/html"); 
    Header("Status: 302 Moved"); 

    // you must have unauthorised.htm in the route of your site, i.e. 
    //http://www.example.com/unauthorised.htm 
    Header("Location: $site/unauthorised.htm"); 
    exit; 
} 

// checks if id is only made up of numbers 
If(!ereg("^[0-9]{1,}$", $_GET['id'])){ 
    Header("Content-type: text/html"); 
    Header("Status: 302 Moved"); 
    Header("Location: $site/unauthorised.htm"); 
    exit; 
} 

session_start(); 

// sets id var from what was sent to page 
// id will be there zone 
$id = $_GET['id']; 

// checks if user has tried to logon before in the same session 
If(!session_is_registered("authrealm"))    { 
    // sets id in a session var 
    session_register(authrealm); 
    $authrealm = $_GET['id']; 
} 

// checks if user is trying to logon to a different company page 
If($authrealm != $_GET['id']){ 
    // resets username and password to blank 
    $PHP_AUTH_USER = ''; 
    unset($PHP_AUTH_USER); 
    $PHP_AUTH_PW = ''; 
    unset($PHP_AUTH_PW); 
    $authrealm = $_GET['id']; 
} 

If(!IsSet($PHP_AUTH_USER)){ 
    // if username hasn't been set before for this realm, prompts 
    //user for username/password 
    Header("WWW-Authenticate: Basic realm=\"$id\""); 
    Header('Status: 401 Unauthorized'); 
    exit; 
} 

// opens database connection 
$connstr = "dbname=**** user=****"; 
$dbh = pg_connect($connstr); 

// sets the SQL statment to recive the user/password for that id $sql = 
"SELECT * FROM **** WHERE **** = '$authrealm'"; 

// executes the SQL statment on the database 
$passdb = pg_exec($dbh, $sql); 

// if database connection failed send to unauthorised page 
If(!$passdb){ 
    Header("Content-type: text/html"); 
    Header("Status: 302 Moved"); 
    Header("Location: $site/unauthorised.htm"); 
    exit; 
} 

// if there is no entry in the database for this id then redirect to 
//unauthorised page 
If(pg_numrows($passdb) == '0'){ 
    Header("Content-type: text/html"); 
    Header("Status: 302 Moved"); 
    Header("Location: $site/unauthorised.htm"); 
    exit; 
} 

$data = pg_fetch_row($passdb, 0); 

// if there is no entry in the database for this id then redirect to 
//unauthorised page 
If(!$data){ 
    Header("Content-type: text/html"); 
    Header("Status: 302 Moved"); 
    Header("Location: $site/unauthorised.htm"); 
    exit; 
} 

// sets username into var $login 
$login = $data[1]; 

//sets a key for the md5 hash (replace stars with numbers execpt the 
//first one) 

// example would be $key = (($id * 9347^7) / 7849^5); 
$key = (($id * ****^*) / ****^*); 

// encrypts the password 
$hash = md5($id.$PHP_AUTH_PW.$key); 

// returns encrypted password from database 
$pass = $data[2]; 

// checks username/password entered against the ones in the database 
//if correct continues on, if wrong redirects you to the unauthorised page 
If((!$PHP_AUTH_USER == '$login') || (!$pass == '$hash')){ 
    Header("Content-type: text/html"); 
    Header("Status: 302 Moved"); 
    Header("Location: $site/unauthorised.htm"); 
    exit; 
} 

pg_close($dbh); 

?> 
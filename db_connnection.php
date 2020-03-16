<?php
function OpenCon()
 {
 $dbhost = "24.165.99.36";
 $dbuser = "staff";
 $dbpass = "without17";
 $db = "voyager";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>
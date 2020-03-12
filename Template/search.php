<?php

$host="localhost";
$port=3306;
$socket="";
$user="dev";
$password="without17";
$dbname="voyager";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
  or die ('Could not connect to the database server' . mysqli_connect_error());
// Check connection
mysql_select_db("voyager")or die(mysql_error());
$safe_value = mysql_real_escape_string($_POST['search']);

$sql = "SELECT * FROM client WHERE name_last LIKE %$safe_value%";

$result = mysql_query("SELECT username FROM member WHERE `username` LIKE %$safe_value%");
 while ($row = mysql_fetch_assoc($result)) {
        echo "<div id='link' onClick='addText(\"".$row['name_first']."\");'>" . $row['name_last'] . "</div>"; 
    }

$con->close();
  
?>
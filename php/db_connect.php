<?php
$host="24.165.99.36";
$port=3306;
$socket="";
$user="staff";
$password="without17";
$dbname="voyager";

$con = mysqli_connect($host, $user, $password, $dbname, $port, $socket);
if (mysqli_connect_errno()) {
  echo "Failed to connect to database server: " . mysqli_connect_error();
  exit();
}
?>
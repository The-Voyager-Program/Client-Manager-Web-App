<?php 
include 'db_connect.php';
$sql = mysqli_query($con, "SELECT * FROM judge");
while ($row = $sql->fetch_assoc()){
echo "<option value=\"".$row['id']."\">". $row['name_prefix'] ." ". $row['name_first'] ." ". $row['name_middle'] ." ". $row['name_last'] . " ". $row['name_suffix'] ."</option>";
}
?>
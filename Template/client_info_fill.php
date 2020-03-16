<?php
$table_head="<thead>
              <tr>
                <th>First</th>
                <th>MI</   th>
                <th>Last</ th>
                <th>Phone</th>
                <th>Email</th>
              </tr>
             </thead>
             <tbody>";

$safe_value = htmlspecialchars($_GET["id"]);

$table="";
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

$sql="SELECT * FROM client WHERE id=".$safe_value."";
$result = mysqli_query($con, $sql);

$out = "";
if($row = mysqli_fetch_assoc($result)){
  $out="
  <table>
    <tr>
      <th style=\"padding: 20px;\">
        <img src=\"pics/ppic.jpg\">
      </th>
      <th style=\"padding: 20px;\">
        <!-- information for client -->
        <table>
          <tr>
            <th class=\"text-secondary\">Client ID:</th>
            <th>".$row['id']."</th>
          </tr>
          <tr>
            <th class=\"text-secondary\">Name:</th>
            <th>".$row['name_first']." ".$row['name_middle']." ".$row['name_last']."</th>
          </tr>
          <tr>
            <th class=\"text-secondary\">Date of Birth:</th>
            <th>".$row['date_of_birth']."</th>
          </tr>
          <tr>
            <th class=\"text-secondary\">SSN:</th>
            <th>".$row['ssn']."</th>
          </tr>
          <tr>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <th class=\"text-secondary\">Address:</th>
            <th>
              <address>
                <p>".$row['address1']."</p>
                <p>".$row['address2']."</p>
                <p>".$row['city'].", ".$row['state']." ".$row['postal']."</p>
              </address>
            </th>
          </tr>
          <tr>
            <th></th>
            <th></th>
          </tr>
          <tr>
            <th class=\"text-secondary\">Judge:</th>
            <th>Judge NAME</th>
          </tr>
          <tr>
            <th class=\"text-secondary\">Officer:</th>
            <th>Officer NAME</th>
          </tr>
        </table>
      </th>
    </tr>
  </table>
  ";
}

mysqli_close($con);
// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($out=="") {
  $response="No client found with ID #".$safe_value;
} else {
  $response=$out;
}
//output the response
//echo $response;
echo $response;

?> 


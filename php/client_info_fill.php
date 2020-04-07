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
    <h4 class=\"card-title\">Client Information</h4>
    <div class=\"row\">
      <div class=\"col-md-2\">
        <img src=\"pics/ppic.jpg\" style=\"max-width: 100%\">
      </div>
      <div class=\"col-md-10\">
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
          </tr>";

  $sqlj="SELECT * FROM judge WHERE id=".$row['judge_id']."";
  $resultj = mysqli_query($con, $sqlj);
  if($rowj = mysqli_fetch_assoc($resultj)){
    $out.="<tr>
            <th class=\"text-secondary\">Judge:</th>
            <th>
              <a href=\"judge_info.html?id=".$rowj['id']."\">
                ".$rowj['name_prefix']." ".$rowj['name_first']." ".$rowj['name_middle']." ".$rowj['name_last']." ".$rowj['name_suffix']."
              </a>
            </th>
          </tr>";
  }else{
    $out.="<tr>
            <th class=\"text-secondary\">Judge:</th>
            <th>NONE</th>
          </tr>";
  }
  $sqlp="SELECT * FROM parole_officer WHERE id=".$row['po_id']."";
  $resultp = mysqli_query($con, $sqlp);
  if($rowp = mysqli_fetch_assoc($resultp)){
    $out.="<tr>
            <th class=\"text-secondary\">Parole Officer:</th>
            <th>
              <a href=\"po_info.html?id=".$rowp['id']."\">
                ".$rowp['name_prefix']." ".$rowp['name_first']." ".$rowp['name_middle']." ".$rowp['name_last']." ".$rowp['name_suffix']."
              </a>
            </th>
          </tr>";
  }else{
    $out.="<tr>
            <th class=\"text-secondary\">Parole Officer:</th>
            <th>NONE</th>
          </tr>";
  }
  $out.="</table>
      </div>
    </div>
  </div>
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


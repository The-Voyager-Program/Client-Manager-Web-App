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

$safe_value = $_GET['search'];

if (strlen($safe_value)>0) {
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

  $sql = "SELECT * FROM client 
          WHERE name_last LIKE '".$safe_value."%' 
          OR name_first LIKE '".$safe_value."%' 
          OR name_middle LIKE '".$safe_value."%' 
          OR email LIKE '".$safe_value."%' 
          OR phone_home LIKE '%".$safe_value."%' 
          OR phone_cell LIKE '%".$safe_value."%' 
          OR phone_work LIKE '%".$safe_value."%' ";
  $result = mysqli_query($con, $sql);

  while($row = mysqli_fetch_assoc($result)) {
    if ($table==""){
      $table=$table_head;
    }
    $table=$table. "<tr cli_id='".$row['id']."'>
                      <th>".$row['name_first']."</th>
                      <th>".$row['name_last' ]."</th>
                      <th type='phone'>".$row['phone_home']."</th>
                      <th>".$row['email'     ]."</th>
                    </tr>";
  }
  //echo "<div id='link' onClick='addText(\"".$row['name_first']."\");'>" . $row['name_last'] . "</div>";
  mysqli_close($con);
  // Set output to "no suggestion" if no hint was found
  // or to the correct values
  if ($table=="") {
    $response="No clients found.";
  } else {
    $response=$table."</tbody>";
  }
  //output the response
  //echo $response;
  echo $response;
}
?> 
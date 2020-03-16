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

$split_values = explode(" ",$safe_value);

$sql="SELECT * FROM client WHERE ";
$count = 0;
$conds=array();

foreach($split_values as $text)
{
  $conds[] = "(
         id LIKE '"         .$text."%' 
      OR name_last LIKE '"  .$text."%' 
      OR name_first LIKE '" .$text."%' 
      OR name_middle LIKE '".$text."%' 
      OR email LIKE '"      .$text."%' 
      OR phone_home LIKE '%".$text."%' 
      OR phone_cell LIKE '%".$text."%' 
      OR phone_work LIKE '%".$text."%')";
}

$sql .= implode(' AND ', $conds);

$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_assoc($result)) {
  if ($table==""){
    $table=$table_head;
  }
  $table=$table."<tr onclick=location.assign(\"/client_info.html?id=".$row['id']."\");>
                   <th>"             .$row['name_first' ]."</th>
                   <th>"             .$row['name_middle']."</th>
                   <th>"             .$row['name_last'  ]."</th>
                   <th type='tel'>"  .$row['phone_home' ]."</th>
                   <th type='email'>".$row['email'      ]."</th>
                 </tr>";
}

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

?> 


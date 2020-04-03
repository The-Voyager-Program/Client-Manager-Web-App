<?php
$table_head="<thead>
              <tr>
                <th>Name</th>
                <th>Phone 1</th>
                <th>Phone 2</th>
                <th>Email</th>
              </tr>
             </thead>
             <tbody>";

$safe_value = $_GET['search'];

include 'db_connect.php';

$split_values = explode(" ",$safe_value);

$sql="SELECT * FROM judge WHERE ";
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
      OR phone1 LIKE '%"    .$text."%' 
      OR phone2 LIKE '%"    .$text."%')";
}

$sql .= implode(' AND ', $conds);

$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_assoc($result)) {
  if ($table==""){
    $table=$table_head;
  }
  $table=$table."<tr onclick=location.assign(\"/judge_info?id=".$row['id']."\");>
                   <th>".$row['name_prefix']." ".$row['name_first']." ".$row['name_middle']." ".$row['name_last']." ".$row['name_suffix']."</th>
                   <th type='tel'>"  .$row['phone1']."</th>
                   <th type='tel'>"  .$row['phone2']."</th>
                   <th type='email'>".$row['email' ]."</th>
                 </tr>";
}

mysqli_close($con);
// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($table=="") {
  $response="No judges found.";
} else {
  $response=$table."</tbody>";
}
//output the response
//echo $response;
echo $response;

?> 


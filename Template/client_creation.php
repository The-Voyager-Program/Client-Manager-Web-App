<?php

$name_first    = $_REQUEST['name_first'];
$name_last     = $_REQUEST['name_last' ];
$gender        = $_REQUEST['gender'    ];
$phone_home    = $_REQUEST['phone_home'];
$email         = $_REQUEST['email'     ];
$address1      = $_REQUEST['address1'  ];
$address2      = $_REQUEST['address2'  ];
$city          = $_REQUEST['city'      ];
$state         = $_REQUEST['state'     ];
$postal        = $_REQUEST['postal'    ];
$country       = $_REQUEST['country'   ];
$month         = $_REQUEST['month'     ];
$day           = $_REQUEST['day'       ];
$year          = $_REQUEST['year'      ];

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

$sql="INSERT INTO client (
name_first, name_last,
gender,     phone_home,
email,      address1,
address2,   city,
state,      postal,
country,    date_of_birth) 
VALUES (
'".$name_first."','".$name_last."',
'".$gender."',    '".$phone_home."',
'".$email."',     '".$address1."',
'".$address2."',  '".$city."',
'".$state."',     '".$postal."',
'".$country."',
STR_TO_DATE('".$month."/".$day."/".$year."','%m/%d/%Y'))";

if(mysqli_query($con, $sql)){
  mysqli_close($con);
  echo "New record created successfully";
}else {
  mysqli_close($con);
  echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

header("Location: clients.html");

exit();
?>
<?php

$name_prefix = $_REQUEST['name_prefix'];
$name_first  = $_REQUEST['name_first' ];
$name_middle = $_REQUEST['name_middle'];
$name_last   = $_REQUEST['name_last'  ];
$name_suffix = $_REQUEST['name_suffix'];
$gender      = $_REQUEST['gender'     ];
$phone_home  = $_REQUEST['phone_home' ];
$phone_home  = $_REQUEST['phone_work' ];
$phone_home  = $_REQUEST['phone_cell' ];
$fax         = $_REQUEST['fax'        ];
$email       = $_REQUEST['email'      ];
$address1    = $_REQUEST['address1'   ];
$address2    = $_REQUEST['address2'   ];
$city        = $_REQUEST['city'       ];
$state       = $_REQUEST['state'      ];
$postal      = $_REQUEST['postal'     ];
$country     = $_REQUEST['country'    ];
$month       = $_REQUEST['month'      ];
$day         = $_REQUEST['day'        ];
$year        = $_REQUEST['year'       ];
$judge       = $_REQUEST['judge'      ];

include 'server_connect.php';

$sql="INSERT INTO client (
name_prefix, name_first,
name_middle, name_last,
name_suffix,  
gender,      phone_home,
phone_work,  phone_cell, 
fax, 
email,       address1,
address2,    city,
state,       postal,
country,     date_of_birth,
judge ) 
VALUES (
'".$name_prefix."','".$name_first."',
'".$name_middle."' ,'".$name_last."',
'".$name_suffix."' , 
'".$gender."',     '".$phone_home."',
'".$phone_work."', '".$phone_cell."',
'".$fax."',
'".$email."',      '".$address1."',
'".$address2."',   '".$city."',
'".$state."',      '".$postal."',
'".$country."',
STR_TO_DATE('".$month."/".$day."/".$year."','%m/%d/%Y'),
'".$judge."')";

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
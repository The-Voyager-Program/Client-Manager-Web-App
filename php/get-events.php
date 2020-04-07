<?php

//--------------------------------------------------------------------------------------------------
// This script reads event data from a JSON file and outputs those events which are within the range
// supplied by the "start" and "end" GET parameters.
//
// An optional "timeZone" GET parameter will force all ISO8601 date stings to a given timeZone.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------

// Require our Event class and datetime utilities
require dirname(__FILE__) . '/utils.php';

// Short-circuit if the client did not give us a date range.
if (!isset($_GET['start']) || !isset($_GET['end'])) {
  die("Please provide a date range.");
}

// Parse the start/end parameters.
// These are assumed to be ISO8601 strings with no time nor timeZone, like "2013-12-29".
// Since no timeZone will be present, they will parsed as UTC.
$range_start = parseDateTime($_GET['start']);
$range_end = parseDateTime($_GET['end']);

// Parse the timeZone parameter if it is present.
$time_zone = new DateTimeZone("America/New_York");
if (isset($_GET['timeZone'])) {
  $time_zone = new DateTimeZone($_GET['timeZone']);
}

include 'db_connect.php';

$sql = "SELECT * FROM meeting";
/* WHERE date_time >= '".$range_start."' AND date_time <= '".$range_end."'"; */

$result = mysqli_query($con, $sql);
$output_arrays=[];
while ($row = mysqli_fetch_assoc($result)) {
  $row["url"]="meeting.html?id=".$row["id"];
  // Convert the input array into a useful Event object
  $event = new Event($row, $time_zone);

  // If the event is in-bounds, add it to the output
  if ($event->isWithinDayRange($range_start, $range_end)) {
    $output_arrays[] = $event->toArray();
  }
}

mysqli_close($con);

// Send JSON to the client.
echo json_encode($output_arrays);

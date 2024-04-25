<?php
$servername = "localhost";
$username = "id22002792_bell_system";
$password = "Siddhi@06";
$database = "id22002792_bell_system_database";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// $page_url =  $_SERVER['PHP_SELF'];
// $data =  explode("/", $page_url);
// $date = $data[3];
// $bell_time = $data[4];
// $duration = $data[5];

$date = $_GET['exam_date'];
$bell_time = $_GET['bell_time'];
$duration = $_GET['duration'];

$sql = "DELETE FROM time_intervals WHERE exam_date = '$date' and bell_time = '$bell_time' and duration = $duration";
// print_r($sql);
// die();
if (mysqli_query($conn, $sql)) {
//  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . mysqli_error($conn);
}

//header("Location: http://localhost/id22002792_bell_system_database/view_time_interval.php");
?>
<script>
    window.location.href='https://automatic-bell-system.000webhostapp.com/view_time_interval.php';
</script>
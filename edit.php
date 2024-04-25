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


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $bell = $_POST['time_interval'];
    $date = $_POST['date'];
    $bell_time = $_POST['bell_time'];
    $duration = $_POST['duration'];
    if($duration == 1 || $duration == 2 || $duration == 3 || $duration == 4 ||$duration == 5 ||$duration == 6 || $duration == 7 || $duration == 8 || $duration == 9){
      $duration = "0".$duration;
    }
    $end_time = $bell.":".$duration;
    $bell = $bell.":00";
    
// echo "<pre>";
// print_r($_POST);
// die();
}

$sql = "UPDATE time_intervals SET bell_time =  '$bell', end_time = '$end_time' WHERE exam_date = '$date' and bell_time = '$bell_time' and duration = $duration";

if (mysqli_query($conn, $sql)) {
 // echo "Record updated successfully";
} else {
  echo "Error updating record: " . mysqli_error($conn);
}

//header("Location: http://localhost/id22002792_bell_system_database/view_time_interval.php");

?>
<script>
    window.location.href='https://automatic-bell-system.000webhostapp.com/view_time_interval.php';
</script>
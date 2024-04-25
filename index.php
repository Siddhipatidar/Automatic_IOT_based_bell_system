<!-- Input from first page i.e. Date and Time intervals  -->
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
//echo "Connected successfully";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  $exam_date = $_POST['date'];
  $time_intervals = $_POST['field'];
  $bell_duration = $_POST['duration'];
  // echo "<pre>";
  // print_r($data);
  // echo "<br>";
  //  print_r($_POST);
  // die();
}

$length = sizeof($time_intervals);

for($i = 0; $i < $length; $i++){
  
  $interval = $time_intervals[$i];
  $duration = $bell_duration[$i];
  if($duration == 1 || $duration == 2 || $duration == 3 || $duration == 4 ||$duration == 5 ||$duration == 6 || $duration == 7 || $duration == 8 || $duration == 9){
    $duration = "0".$duration;
  }
  $end_time = $interval.":".$duration;
  $interval = $interval.":00";
   
  $sql = "INSERT INTO time_intervals (exam_date, bell_time, duration, end_time)
  VALUES ('$exam_date', '$interval', $duration, '$end_time')";

  if (mysqli_query($conn, $sql)) {
 //   echo "New record inserted successfully";
 //   echo "<br>";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

mysqli_close($conn);

//header("Location: view_time_interval.php");
//exit();


?>
<script>
    window.location.href='https://automatic-bell-system.000webhostapp.com/view_time_interval.php';
</script>

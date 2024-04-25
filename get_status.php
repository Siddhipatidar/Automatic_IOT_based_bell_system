
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

$sql = "SELECT status FROM ring";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

echo "<pre>";
print_r($row['status']);
die();

?>

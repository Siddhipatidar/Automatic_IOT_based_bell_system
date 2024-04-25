<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>IOT based Bell System</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />

  <style>
    .body{
      margin: 0;
      padding: 0;
      background-color: rgb(148,109,180);
    }

    .bell{
      color: yellow;
    }
  </style>

</head>

<!-- ******************************************************************************************** -->
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

$date = $_GET['exam_date'];
$bell_time = $_GET['bell_time'];
$duration = $_GET['duration'];
            
?>
<!-- ******************************************************************************************************* -->
<body class="body">
    <div class="container my-4">
      <p class="h1" style="font-style: italic; font-family: sans-serif;"><b> Update Bell <span class="bell"><i class="fa fa-bell" aria-hidden="true"></i></span> Time Interval</b></p>
      <div class="card my-4 shadow">
        <div class="card-body">
         <form action="https://automatic-bell-system.000webhostapp.com/edit.php" method="post" target="_blank">  
          <table class="table table-bordered table-shadow table-striped table-hover">
            <thead>
              <tr>
                <th scope="col" style="text-align: center;">S.No.</th>
                <th scope="col" style="text-align: center;">Date of Exam</th>
                <th scope="col" style="text-align: center;">Previous Bell Time</th>
                <th scope="col" style="text-align: center;">Duration</th>
                <th scope="col" style="text-align: center;">Update Time Interval</th>
              </tr>
            </thead>
            <tbody>            
              <input type="hidden" name="date" value="<?php echo $date; ?>">
              <input type="hidden" name="bell_time" value="<?php echo $bell_time; ?>">
              <input type="hidden" name="duration" value="<?php echo $duration; ?>">
               <tr>
                <th scope="row" style="text-align: center;"><?php echo "1";?></th>
                <td style="text-align: center;"><?php echo $date; ?></td>
                <td style="text-align: center;"><?php  echo  $bell_time?></td>
                <td style="text-align: center;"><?php  echo $duration; ?></td>
                
                <td align="center">
                   <input type="time" name="time_interval" id="field" class="form-control"/>
                </td>

              </tr>
            </tbody>
          </table>
          <button type="submit" class="btn btn-primary float-right text-uppercase shadow-sm">Submit</button>
</form>
        </div>
      </div>
      
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 
    <script  src="./script.js">

      // function delete(){
      //   alert("Are you sure, you want to delete !!!");
      // }
    </script>

</body>
</html>


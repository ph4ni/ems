<?php
// Get the event ID from the GET request
$event_id = $_GET['eventid'];

// Connect to the database
$servername = "localhost";
    $username = "geon";
    $password = "geon";
    $dbname = "formsdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Find the form_name from the events_table using the event_id
$sql = "SELECT form_name FROM events_table WHERE event_id = '$event_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Get the form_name from the query result
    $row = $result->fetch_assoc();
    $form_name = $row['form_name'];
    //echo $form_name;
    
} else {
    // Display an error message if the event_id is not found
    echo "Event ID not found.";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>

  </head>
  <body>
    <div class="row" align="center">
        <div class="col-4-lg">
                
            <form method="post" action="insert.php">
                <h1>Attendance for <?php echo $form_name ?></h1>
                <h3 style="color:blue;">Scan your QR Code</h3>
                <input type="hidden" readonly="" name="sid" id="sid"/>
                <input type="hidden" name="fname" value="<?php echo $form_name ?>"/>
                <input type="hidden" name="eid" id="eid" value="<?php echo $event_id ?>"/>
            </form>
            <video id="preview"></video>
        </div>
    </div>
    <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        console.log(content);
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });

      scanner.addListener('scan',function(c){
        document.getElementById("sid").value=c;
        document.forms[0].submit();
      });
    </script>
</body>
</html>
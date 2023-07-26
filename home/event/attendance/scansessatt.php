<?php
    // Get the event ID from the GET request
    $sid = $_GET['sid'];
    $attdbname = $_GET['attdbname'];

    $last_underscore_pos = strrpos($attdbname, '_');
    $name_before_last_underscore = substr($attdbname, 0, $last_underscore_pos);
    $sesstable = $name_before_last_underscore . '_sessions';


    //$name_parts = explode("_", $attdbname);
    //$sesstable = $name_parts[0] . "_sessions";
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
    $sql = "SELECT sname FROM $sesstable WHERE sid = '$sid'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Get the form_name from the query result
        $row = $result->fetch_assoc();
        $sname = $row['sname'];
        $snameunder = str_replace(' ', '_', $sname);
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
                <h1>Attendance for <?php echo $sname ?></h1>
                <h3 style="color:blue;">Scan your QR Code</h3>
                <input type="hidden" readonly="" name="scannedsid" id="scannedsid"/>
                <input type="hidden" name="snameunder" value="<?php echo $snameunder ?>"/>
                <input type="hidden" name="attdbname" value="<?php echo $attdbname ?>"/>
                <!-- <input type="hidden" name="eid" id="eid" value="<?php //echo $event_id ?>"/> -->
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
        document.getElementById("scannedsid").value=c;
        document.forms[0].submit();
      });
    </script>
</body>
</html>
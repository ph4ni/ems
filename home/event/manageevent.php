<!DOCTYPE html>
<html>
<head>

<style>
    .navtop {
      position: fixed;
      z-index: 999;
	background-color: #2f3947;
	height: 60px;
	width: 100%;
	border: 0;
}
.navtop div {
	display: flex;
	margin: 0 auto;
	width: 99%;
	height: 100%;
}
.navtop div h1, .navtop div a {
	display: inline-flex;
	align-items: center;
}
.navtop div h1 {
	flex: 1;
	font-size: 24px;
	padding: 0;
	margin: 0;
	color: #eaebed;
	font-weight: normal;
}
.navtop div a {
	padding: 0 20px;
	text-decoration: none;
	color: #c1c4c8;
	font-weight: bold;
}
.navtop div a i {
	padding: 2px 8px 0 0;
}
.navtop div a:hover {
	color: #eaebed;
}
body {
  margin: 0;
  font-family: "Lato", sans-serif;
}

.sidebar {
  
  margin-top: 60px;
  padding: 0;
  width: 17%;
  background-color: #427AA1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: #ffffff ;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #427AA1 ;
  color: white;
}
.active{
  margin-left: 25px;
}
.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}
a.active:hover{
  background-color: #555;
  color: white;
}
div.content {
margin-top: 70px;
  width: 83%;
  margin-left: 17%;
  /* border-style: double; */
  height: 99%;
  position: absolute;
  top: 0;
  bottom: 0;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">

</head>
<body>
  <?php 
    $eventid = $_GET['event_id'];
    //echo $eventid;
    $servername = "localhost";
    $username = "geon";
    $password = "geon";
    $dbname = "formsdb";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }     
  ?>
      <nav class="navtop">
          <div>
              <h1>Events Management System</h1>
              <a href="../home.php"><i class="fas fa-home-circle"></i>Home</a>
              <a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
          </div>
      </nav>
  <div class="sidebar">
      <?php $sql = "SELECT event_name FROM events_table WHERE event_id = $eventid";
        $result = $conn->query($sql);
        
        if ($result === false) {
          // If query failed, print error message and SQL query
          echo "Error: " . $conn->error . "<br>";
          echo "SQL query: " . $sql . "<br>";
      } elseif ($result->num_rows > 0) {
            // If form exists, display form name
            $row = $result->fetch_assoc();
            $eventname = $row["event_name"];
            echo '<a style="background-color:yellow; color:black;" >'.$eventname.'</a>';
      }else{
        echo "Event not found.";
      }
      ?>
    <a onclick="openf()" >Forms</a>
    <div id="forms" style="display: none;">
      <?php
        $sql = "SELECT form_name FROM events_table WHERE event_id = $eventid";
        $result = $conn->query($sql);
        
        if ($result === false) {
          // If query failed, print error message and SQL query
          echo "Error: " . $conn->error . "<br>";
          echo "SQL query: " . $sql . "<br>";
          } elseif ($result->num_rows > 0) {
                // If form exists, set href to 'forms/$form_name'
                $row = $result->fetch_assoc();
                $form_name = $row["form_name"];
                if ($form_name !== NULL) {
                    echo '<a class="active" href="forms/public/'.strval($eventid).'/'.$form_name.'.html" target="fra1">View Forms</a>';
                } else {
                   // echo '<a class="active" href="forms/generate.php?eventid='.$eventid.' target="fra1">View Forms</a>';
                    echo '<a class="active" href="forms/generate.php?eventid='.$eventid.'" target="fra1">View Forms</a>';
                }
            } else {
                echo "Event not found.";
            }
      ?>
      <a class="active" href="forms/submissions.php?eventid=<?php echo $eventid;?>"  target="fra1">View Submissions</a>
    </div>
    <a onclick="opena()">Attendance</a>
    <div id="attendance" style="display: none;">
      <a class="active" href="attendance/viewsess.php?eventid=<?php echo $eventid;?>" target="fra1">Take attendance</a>
      <a class="active" href="attendance/viewsessattn.php?eventid=<?php echo $eventid;?>" target="fra1">View attendance data</a>
    </div>
    <a onclick="openc()">Certificates</a>
    <div id="certificates" style="display: none;">
      <a class="active" href="certificates/checkcert.php?eventid=<?php echo $eventid;?>" target="fra1">Check eligibility</a>
      <a class="active" href="certificates/viewcert.php?eventid=<?php echo $eventid;?>" target="fra1">Generate certificates</a>
    </div>
    <a onclick="opens()">Settings</a>
    <div id="settings" style="display: none;">
      <a class="active" href="../retrieve/ach_retrieve.php" target="fra1">Users of <?php echo $eventid ?></a>
      <a class="active" href="forms/viewform.php?eventid=<?php echo $eventid; ?>" target="fra1">View structure</a>
      <a  class="active" href="logout.php">Logout</a>
    </div>
    
  </div>

  <div class="content">
    <iframe height="100%" width="100%" float="right" frameborder="0" name="fra1" src="a.html">
    </iframe>
  </div>
  <script>
    function openf() {
      if (document.getElementById("forms").style.display == "none") {
          document.getElementById("forms").style.display = "block";
      } else {
          document.getElementById("forms").style.display = "none";
      }
    }
    function opena() {
      if (document.getElementById("attendance").style.display == "none") {
          document.getElementById("attendance").style.display = "block";
      } else {
          document.getElementById("attendance").style.display = "none";
      }
    }
    function openc() {
      if (document.getElementById("certificates").style.display == "none") {
          document.getElementById("certificates").style.display = "block";
      } else {
          document.getElementById("certificates").style.display = "none";
      }
    }
    function opens() {
      if (document.getElementById("settings").style.display == "none") {
          document.getElementById("settings").style.display = "block";
      } else {
          document.getElementById("settings").style.display = "none";
      }
    }
    function closei(){
      document.getElementById("insert").style.display = "none";
    }
  </script>
<?php
  $conn->close();
?>
</body>
</html>
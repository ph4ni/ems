<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Navigation Bar</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav flex-column">
          <li class="nav-item active">
            <a class="nav-link" href="default.php" target="content">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="#formSubMenu" data-toggle="collapse" aria-expanded="false">Form</a>
            <ul class="list-unstyled collapse" id="formSubMenu">
              <li>
                <a class="nav-link" href="createform.php?event_id=<?php echo $event_id; ?>" target="content">Create Form</a>
              </li>
              <li>
                <a class="nav-link" href="viewform.php?event_id=<?php echo $event_id; ?>" target="content">View Form</a>
              </li>
              <li>
                <a class="nav-link" href="viewsubmissions.php?event_id=<?php echo $event_id; ?>" target="content">View Submissions</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
                <a class="nav-link collapsed" href="#attendanceSubMenu" data-toggle="collapse" aria-expanded="false">Attendance</a>
                <ul class="list-unstyled collapse" id="attendanceSubMenu">
                <li>
                <a class="nav-link" href="sessions.php?event_id=<?php echo $event_id; ?>" target="content">Sessions</a>
              </li>
              <li>
                <a class="nav-link" href="takeattendance.php?event_id=<?php echo $event_id; ?>" target="content">Take Attendance</a>
              </li>
              <li>
                <a class="nav-link" href="viewattendance.php?event_id=<?php echo $event_id; ?>" target="content">View Attendance</a>
                </li>
            </ul>  
            </li> 
            <li class="nav-item">
            <a class="nav-link collapsed" href="#formSubMenu" data-toggle="collapse" aria-expanded="false">Certificates</a>
            <ul class="list-unstyled collapse" id="formSubMenu">
              <li>
                <a class="nav-link" href="createform.php?event_id=<?php echo $event_id; ?>" target="content">Generate</a>
              </li>
              <li>
                <a class="nav-link" href="viewform.php?event_id=<?php echo $event_id; ?>" target="content">View</a>
              </li>
              <li>
                <a class="nav-link" href="viewsubmissions.php?event_id=<?php echo $event_id; ?>" target="content">Download</a>
              </li>
            </ul>
          </li>
        </ul>
</div>
</body>
</html>
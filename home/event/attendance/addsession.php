<?php
     $servername = "localhost";
     $username = "geon";
     $password = "geon";
     $dbname = "formsdb";

     $conn = new mysqli($servername, $username, $password, $dbname);

     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }

    if (isset($_POST['sdbn'])) {
        $sessdbname = $_POST['sdbn'];
        $eventid = $_POST['eventid'];
        // Process form data here
    } else {
        echo "Error: No session DB name provided.";
    }

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
		</style>
	</head>
	<body class="loggedin">
        <!-- Link to Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<div class="content">
            <!-- HTML code for add event form using Bootstrap -->
            <div class="container mt-5">
                <h2>Create New Session</h2>
                <form method="post" action="addinglogic.php">
                    <input type="hidden" name="sessdbname" value="<?php echo $sessdbname; ?>">
                    <input type="hidden" name="eventid" value="<?php echo $eventid; ?>">
                    <div class="form-group">
                        <label for="sname">Session Name:</label>
                        <input type="text" class="form-control" id="sname" name="sname" required>
                    </div>
                    <div class="form-group">
                        <label for="sdate">Date:</label>
                        <input type="date" class="form-control" id="sdate" name="sdate" required>
                    </div>
                    <div class="form-group">
                        <label for="stimestart">Start Time:</label>
                        <input type="TIME" class="form-control" id="stimestart" name="stimestart" required>
                    </div>
                    <div class="form-group">
                        <label for="stimeend">End Time:</label>
                        <input type="TIME" class="form-control" id="stimeend" name="stimeend" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
		</div>
	</body>
</html>
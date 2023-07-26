<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="homestyle.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
		<!-- Import Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- Import jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Import Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<style>

		</style>
	</head>
	<body class="loggedin">
		<div class="container">
			<br><h3>Check eligibility of students</h3><br>
			<div class="row">
			<?php
				// Connect to the database
				$servername = "localhost";
				$username = "geon";
				$password = "geon";
				$dbname = "formsdb";

				$conn = new mysqli($servername, $username, $password, $dbname);

				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

                $eventid = $_GET['eventid'];
				//echo $eventid;
                $sql = "SELECT form_name FROM events_table WHERE event_id = $eventid";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $form_name = $row["form_name"];
                $sessdbname = $form_name . "_sessions";
                $attdbname = $form_name . "_att";
                
                $sesscountquery = "SELECT COUNT(*) FROM $sessdbname";
                $result = mysqli_query($conn, $sesscountquery);
                $sesscount = mysqli_fetch_array($result)[0];
                echo "$sesscount sessions found";

                // Fetch sessions from sessionstable
                $integer ="";
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $integer = test_input($_POST["integer"]);
                }

				$conn->close();
                echo $integer;
			?>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?variable=<?php echo $eventid; ?>" method="GET">
                <br>
                Enter minimum sessions needed:<input type="number" name="integer">
                <br><br>
                <input type="submit" name="submit" value="Submit">
            </form>

		</div>
	</body>
</html> 

<!DOCTYPE html>
<html>
<head>
	<title>Create a Form</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<style>
		body {
			padding: 50px;
		}

		.titles {
			font-weight: bold;
			text-align: center;
		}

		form label {
			display: inline-block;
			width: 150px;
			margin-right: 10px;
			text-align: right;
		}

		form input[type="text"],
		form select,
		form textarea {
			display: inline-block;
			width: 300px;
			margin-right: 10px;
		}
		.form_field {
    margin-bottom: 10px;
		}
		.form_field label[for^="field"] + select {
		display: inline-block;
		width: 150px;
		margin-right: 10px;
		}
		h2 {
			text-align: center;
		}

		button, input[type="submit"] {
			display: block; /* Set the display property to block to use flexbox */
			margin: 0 auto; /* Set horizontal margin to auto to center horizontally */
			}

		.form-buttons {
			display: flex; /* Set the display property of the parent element to flex */
			justify-content: center; /* Center horizontally */
			align-items: center; /* Center vertically */
		}

	</style>
</head>
<body>
	<?php 
    	$event_id = $_GET['eventid'];
		//echo $event_id;
		$servername = "localhost";
		$username = "geon";
		$password = "geon";
		$dbname = "formsdb";
		
		$conn = new mysqli($servername, $username, $password, $dbname);

		$sql = "SELECT event_name FROM events_table WHERE event_id = $event_id";
        $result = $conn->query($sql);
		$row = $result->fetch_assoc();
        $eventname = $row["event_name"];
	?>
	<div class="container">
		<h2>Create Form for <?php echo $eventname; ?></h2>
		<hr class="hr" />
		<form method="post" action="generatenew.php?event_id=<?php echo $event_id; ?>">
			<label class="titles">Form Information:</label>
			<div class="form-group">
				<label for="form_name">Form Name:</label>
				<input type="text" class="form-control" id="form_name" name="form_name" required>
			</div>
			<div class="form-group">
				<label for="form_description">Form Description:</label>
				<input type="text" class="form-control" id="form_description" name="form_description">
			</div>
			<div class="form-group">
				<hr class="hr" />
				<label class="titles" for="form_fields">Form Fields:</label>
				<div id="form_fields">
					<div class="form_field">
						<div style="display: inline-block;">
							<label for="field1_name">Field Name:</label>
							<input type="text" class="form-control" id="field1_name" name="field_name[]" required>
						</div>
						<div style="display: inline-block;">
							<label for="field1_type">Field Type:</label>
							<select class="form-control" id="field1_type" name="field_type[]" required>
								<option value="">-- Select --</option>
								<option value="text">Text</option>
								<option value="text">Number</option>
								<option value="DATE">Date</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="form-buttons">
				<button type="button" class="btn btn-primary" onclick="addField()">Add Field</button>
				<br><br>
			</div>
			<hr class="hr" />	
			<div class="form-buttons">
			
				<input type="submit" class="btn btn-success" value="Generate Form">
			</div>

		</form>
	</div>
			<script>
		var fieldCounter = 1;

		function addField() {
			fieldCounter++;
			var newField = document.createElement("div");
			newField.innerHTML = '<div class="form_field">' +
				'<label for="field' + fieldCounter + '_name">Field Name:</label>' +
				'<input type="text" class="form-control" id="field' + fieldCounter + '_name" name="field_name[]" required>' +
				'<label for="field' + fieldCounter + '_type">Field Type:</label>' +
				'<select class="form-control" id="field' + fieldCounter + '_type" name="field_type[]" required>' +
				'<option value="">-- Select --</option>' +
				'<option value="text">Text</option>' +
				'<option value="text">Number</option>' +
				'<option value="DATE">Date</option>' +
				'</select>';
			document.getElementById("form_fields").appendChild(newField);
			;
		}
	</script>
</body>
</html>
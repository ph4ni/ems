<?php
// get form data
$form_name = $_POST['form_name'];
$form_description = $_POST['form_description'];
$field_names = $_POST['field_name'];
$field_types = $_POST['field_type'];


$event_id = $_GET['event_id'];

/*
foreach($field_names as $key => $value)
{
  echo $key." has the value". $value;
}
foreach($field_types as $key => $value)
{
  echo $key." has the value". $value;
}*/

// connect to MySQL database
$servername = "localhost";
$username = "geon";
$password = "geon";
$dbname = "formsdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//replace spaces with underscore

$form_name = str_replace(" ", "_", $form_name);

// create form table in database
$sql = "CREATE TABLE $form_name (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
	
for ($i = 0; $i < count($field_names); $i++) {
	$sql .= $field_names[$i] . " " . $field_types[$i] . ",";
}

$sql = rtrim($sql, ","); // remove last comma
$sql .= ")";

if ($conn->query($sql) === FALSE) {
	echo "Error creating table: " . $conn->error;
}

$certfield = "ALTER TABLE $form_name ADD cert BOOLEAN DEFAULT FALSE";
if ($conn->query($certfield) === FALSE) {
	echo "Error adding certificate field: " . $conn->error;
}

//create attendance table in database
$table_nameee = $form_name . "_att";

$sqll = "CREATE TABLE $table_nameee (id INT(6) PRIMARY KEY);";

if ($conn->query($sqll) === FALSE) {
	echo "Error creating att table: " . $conn->error;
}

$table_nameg = $form_name . "_sessions";
	$sql = "CREATE TABLE $table_nameg (
        sid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
        sname VARCHAR(100), 
        sday DATE, 
        stimestart TIME, 
        stimeend TIME
    )";

if ($conn->query($sql) === FALSE) {
    echo "Error creating sessions table: " . $conn->error;
}

//update events table with event name
$stmt = $conn->prepare("UPDATE events_table SET form_name=? WHERE event_id=?");
$stmt->bind_param("si", $form_name, $event_id);

if ($stmt->execute() === FALSE) {
	echo "Error updating form name " . $stmt->error;
}

$stmt->close();

// create event folder if not exists
if (!file_exists("public/$event_id")) {
    mkdir("public/$event_id", 0777, true);
}

if (!file_exists("public/$event_id/qr_codes")) {
    mkdir("public/$event_id/qr_codes", 0777, true);
}

/*
// create form_name.html file
$html_file = fopen("public/$event_id/$form_name.html", "w");
$html_content = "<!DOCTYPE html>\n<html>\n<head>\n\t<title>$form_name</title>\n</head>\n<body>\n\t<h2>$form_name</h2><p>$form_description</p><form action=".$form_name."_submit.php method=\"post\">\n";
	
for ($i = 0; $i < count($field_names); $i++) {
	$html_content .= "\t\t<label for=\"" . $field_names[$i] . "\">" . $field_names[$i] . ":</label>\n";
	
	if ($field_types[$i] == "textarea") {
		$html_content .= "\t\t<textarea id=\"" . $field_names[$i] . "\" name=\"" . $field_names[$i] . "\"></textarea>\n";
	} else {
		$html_content .= "\t\t<input type=\"" . $field_types[$i] . "\" id=\"" . $field_names[$i] . "\" name=\"" . $field_names[$i] . "\"><br><br>\n";
	}
	
	}
	
	$html_content .= "\t\t<input type=\"submit\" value=\"Submit\">\n\t</form>\n</body>\n</html>";
	fwrite($html_file, $html_content);
	fclose($html_file);
	
	<?php */
		// create form_name.html file
		$html_file = fopen("public/$event_id/$form_name.html", "w");
		$html_content = "<!DOCTYPE html>\n<html>\n<head>\n\t<title>$form_name</title>\n";
		// Add Bootstrap CSS
		$html_content .= "\t<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">\n";
		$html_content .= "</head>\n<body class=\"text-center\">\n";
		$html_content .= "\t<div class=\"container\">\n";
		// Style form_name h2 with background
		$html_content .= "\t\t<h2 class=\"bg-primary\">$form_name</h2>\n\t\t<p>$form_description</p>\n";
		$html_content .= "\t\t<form class=\"form-horizontal\" action=\"".$form_name."_submit.php\" method=\"post\">\n";

		for ($i = 0; $i < count($field_names); $i++) {
			$html_content .= "\t\t\t<div class=\"form-group\">\n";
			// Style label and input field in the same line
			$html_content .= "\t\t\t\t<label class=\"control-label col-sm-2\" for=\"" . $field_names[$i] . "\">" . $field_names[$i] . ":</label>\n";
			$html_content .= "\t\t\t\t<div class=\"col-sm-10\">\n";
			if ($field_types[$i] == "textarea") {
				$html_content .= "\t\t\t\t\t<textarea class=\"form-control\" id=\"" . $field_names[$i] . "\" name=\"" . $field_names[$i] . "\"></textarea>\n";
			} else {
				$html_content .= "\t\t\t\t\t<input type=\"" . $field_types[$i] . "\" class=\"form-control\" id=\"" . $field_names[$i] . "\" name=\"" . $field_names[$i] . "\">\n";
			}
			$html_content .= "\n\t\t\t</div>\n";
			$html_content .= "\t\t\t</div>\n";
		}

		$html_content .= "\t\t\t<input type=\"submit\" class=\"btn btn-primary\" value=\"Submit\">\n\t\t</form>\n";
		$html_content .= "\t</div>\n";
		// Add Bootstrap JS
		$html_content .= "\t<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>\n";
		$html_content .= "\t<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>\n";
		$html_content .= "</body>\n</html>";

		fwrite($html_file, $html_content);
		fclose($html_file);
	
	// create form_name_submit.php file
	$submit_file = fopen("public/$event_id/$form_name"."_submit.php", "w");
	$submit_content = "<?php\n

	\$conn = new mysqli('$servername', '$username' , '$password', '$dbname');

	if (\$conn->connect_error) {
		die(\"Connection failed: \" . \$conn->connect_error);
	}
	";

	for ($i = 0; $i < count($field_names); $i++) {
		$submit_content .= "$" . $field_names[$i] . " = \$_POST['" . $field_names[$i] . "'];\n";
	}

	$submit_content .= "\n// insert data into database\n";
	$submit_content .= "\$sql = \"INSERT INTO $form_name (";
	for ($i = 0; $i < count($field_names); $i++) {
		$submit_content .= $field_names[$i] . ",";
	}
	$submit_content = rtrim($submit_content, ","); // remove last comma
	$submit_content .= ") VALUES (";
	for ($i = 0; $i < count($field_names); $i++) {
		$submit_content .= "'$" . $field_names[$i] . "',";
	}
	$submit_content = rtrim($submit_content, ","); // remove last comma
	$submit_content .= ")\";\n\n";
	$submit_content .= "if (\$conn->query(\$sql) === FALSE) {\n";
	$submit_content .= "\techo \"Error: \" .". "\$sql.\"" . "\$conn->error\";\n";
	$submit_content .= "}\n\n";
	$submit_content .= "\$id = \$conn->insert_id;\n"; // get the auto-increment ID of the inserted row
	$submit_content .= "if (\$id) {\n"; // if ID is valid, generate and display QR code
	$submit_content .= "    include_once '../phpqrcode/qrlib.php';\n";
	$submit_content .= "	\$sqll = \"INSERT INTO $form_name"."_att (id) VALUES (\$id)\";";
	$submit_content .= "	if (\$conn->query(\$sqll) === FALSE) {\n";
	$submit_content .= "		\techo \"Error: \" .". "\$sql.\"" . "\$conn->error\";\n";
	$submit_content .= "}\n\n";
	$submit_content .= "    \$qrCodePath = 'qr_codes/'.\$id . '.png';\n";
	$submit_content .= "    QRcode::png(\$id, \$qrCodePath);\n";
	//$submit_content .= "    echo '<img center src=\"' . \$qrCodePath . '\" alt=\"QR Code\">';\n";
	$submit_content .= "}\n\n";
	$submit_content .= 'echo "<div class=\"text-center\">";';
	$submit_content .= 'echo "Your form has been submitted!<br>\n";
	echo "<img center src=\'" . $qrCodePath . "\' alt=\'QR Code\'>";' . "\n";


	$submit_content .= "echo \"Save this QR code for attendance\n</div>\"\n?>" ;

	fwrite($submit_file, $submit_content);
	fclose($submit_file);

	echo "Form created successfully.";

	$conn->close();

?>
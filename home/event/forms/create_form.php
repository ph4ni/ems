<?php
// retrieve form data from POST request
$form_name = $_POST['form_name'];
$form_description = $_POST['form_description'];
$field_names = $_POST['field_name'];
$field_types = $_POST['field_type'];

// connect to MySQL database
$servername = "localhost";
$username = "geon";
$password = "geon";
$dbname = "formsdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

// create MySQL table to store form results
$sql = "CREATE TABLE ".$form_name." (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
for ($i=0; $i<count($field_names); $i++) {
	$sql .= ", ".$field_names[$i]." ";
	switch ($field_types[$i]) {
		case "text":
			$sql .= "TEXT";
			break;
		case "textarea":
			$sql .= "TEXT";
			break;
		case "select":
			/*$sql .= "VARCHARACTER";
			// add options to MySQL table if field type is select
			$options = explode(",", $_POST['field'.$i.'_options']);
			foreach ($options as $option) {
				$sql .= ", ".$option." VARCHARACTER";
			}*/
			break;
	}
}

$sql .= ")";

if (mysqli_query($conn, $sql)) {
	echo "Table created successfully";
} else {
	echo "Error creating table: " . mysqli_error($conn);
}

// generate HTML frontend for new form
$html = "<!DOCTYPE html>\n<html>\n<head>\n\t<title>".$form_name."</title>\n</head>\n<body>\n<h1>".$form_name."</h1>\n<p>".$form_description."</p>\n<form method='post' action='submit_form.php'>\n";
for ($i=0; $i<count($field_names); $i++) {
	$html .= "\t<label for='".$field_names[$i]."'>".$field_names[$i]."</label>\n";
	switch ($field_types[$i]) {
		case "text":
			$html .= "\t<input type='text' id='".$field_names[$i]."' name='".$field_names[$i]."'><br><br>\n";
			break;
		case "textarea":
			$html .= "\t<textarea id='".$field_names[$i]."' name='".$field_names[$i]."'></textarea><br><br>\n";
			break;
		case "select":
			$options = explode(",", $_POST['field'.$i.'_options']);
			$html .= "\t<select id='".$field_names[$i]."' name='".$field_names[$i]."'>\n";
			foreach ($options as $option) {
				$html .= "\t\t<option value='".$option."'>".$option."</option>\n";
			}
			$html .= "\t</select><br><br>\n";
			break;
	}
}
$html .= "\t<input type='submit' value='Submit'>\n</form>\n</body>\n</html>";

// save HTML frontend to file
$file = fopen($form_name.".html", "w");
fwrite($file, $html);
fclose($file);

mysqli_close($conn);
?>

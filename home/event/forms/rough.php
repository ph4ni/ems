// create event folder if not exists
if (!file_exists("public/$event_id")) {
    mkdir("public/$event_id", 0777, true);
}

// create form_name_submit.php file inside event folder
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
$submit_content .= "    \$qrCodePath = '../qrcodes/' . \$id . '.png';\n";
$submit_content .= "    QRcode::png(\$id, \$qrCodePath);\n";
$submit_content .= "    echo '<img src=\"' . \$qrCodePath . '\" alt=\"QR Code\">';\n";
$submit_content .= "}\n\n";
$submit_content .= "echo \"Data inserted successfully.\";\n";
$submit_content .= "?>" ;

fwrite($submit_file, $submit_content);
fclose($submit_file);

echo "Form created successfully.";

$conn->close();

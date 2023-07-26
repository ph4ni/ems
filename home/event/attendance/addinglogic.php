<?php
// Get the session name from the hidden input field
    $sessdbname = $_POST['sessdbname'];
    $eventid = $_POST['eventid'];
    // Get the form data
    $last_underscore_pos = strrpos($sessdbname, '_');
    $name_before_last_underscore = substr($sessdbname, 0, $last_underscore_pos);
    $atttable = $name_before_last_underscore . '_att';

    //$name_parts = explode("_", $sessdbname);
    //$atttable = $name_parts[0] . "_att";
    //echo $atttable; // Outputs "name_att"


    $sname = $_POST['sname'];
    $sname = str_replace(' ', '_', $sname);
    $sdate = $_POST['sdate'];
    $stimestart = $_POST['stimestart'];
    $stimeend = $_POST['stimeend'];

    $servername = "localhost";
     $username = "geon";
     $password = "geon";
     $dbname = "formsdb";

     $conn = new mysqli($servername, $username, $password, $dbname);
    // Connect to the database
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the form data into the database`
    $sql = "INSERT INTO $sessdbname (sname, sday, stimestart, stimeend) VALUES ('$sname', '$sdate', '$stimestart', '$stimeend')";
    if ($conn->query($sql) === TRUE) {
        // Get the id of the last inserted row in $sessdbname
        $last_inserted_id = $conn->insert_id;
        
        // Create a new column "sid" in $sessatt table with $last_inserted_id as primary key
        $sql_create_column = "ALTER TABLE $atttable ADD $sname INT NOT NULL DEFAULT 0";
        if ($conn->query($sql_create_column) === TRUE) {
            header("Location: viewsess.php?eventid=$eventid");
            exit();
        } else {
            echo "Error creating column: " . $conn->error;
        }
    } else {
        echo "Error inserting session: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
?>

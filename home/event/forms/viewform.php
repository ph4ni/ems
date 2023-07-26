<?php
   // $eventid = $_GET['eventid'];
    //echo $eventid;

    //$file_path = "../../forms/example.php";
    $file_path = "../../forms/example.php";
    $content = "<?php echo 'Hello, World!'; ?>";

    // Create the file and write content to it
    file_put_contents($file_path, $content);

    echo "File created successfully.";


?>
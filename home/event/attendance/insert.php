<?php
    $servername = "localhost";
    $username = "geon";
    $password = "geon";
    $dbname = "formsdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if(isset($_POST['snameunder'])){
        $snameunder=$_POST['snameunder'];
        $attdbname=$_POST['attdbname'];
        $scannedsid=$_POST['scannedsid'];
        //$eid=$_POST['eid'];
        
        $sql= 'UPDATE  '.$attdbname.'  SET '.$snameunder .'= 1 WHERE id ='.$scannedsid.';';
        //echo $sql;
        mysqli_query($conn,$sql);
        
        header('Location:done.php?msg=attendance taken, thank you&id='.$scannedsid);
    }
    
?>
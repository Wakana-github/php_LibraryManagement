<?php
 //Connect to database
 $USER     = "root";
 $PASSWORD = " "; //type in your database passeord
 $DBNAME   = "library";
 $conn = mysqli_connect("localhost", $USER, $PASSWORD, $DBNAME)
            or die("mySQL server connection failed");
?>

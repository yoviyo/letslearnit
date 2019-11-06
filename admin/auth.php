<?php
	$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sunhotel";

    // Create connection
    $con = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$con) {
        die("Връзката е неуспешна: " . mysqli_connect_error());
    }


?>
<?php

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'expense-tracker';
    $flag = false;
    $conn = mysqli_connect($host,$username,$password);

    //selecting databse
    $db_query = "SELECT SCHEMA_NAME  FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db'";
    $rs = mysqli_query($conn,$db_query);

    if (!mysqli_num_rows($rs) > 0) {
        //creating databse if not exists...
        $db_query = "CREATE DATABASE IF NOT EXISTS `$db`";
        if (mysqli_query($conn,$db_query)) {
            $flag = true;
        }
    }

    $conn = mysqli_connect($host,$username,$password,$db);

    if ($flag) {
        // databse file included if database not exists
        include './db_queries.php';    
    }
    echo mysqli_error($conn);

    if (!$conn) {
        die("Error while connecting to database");
    }

?>
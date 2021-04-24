<?php

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'expense-tracker';

    $conn = mysqli_connect($host,$username,$password,$db);

    if (!$conn) {
        die("Error while connecting to database");
    }

?>
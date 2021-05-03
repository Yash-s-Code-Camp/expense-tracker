<?php
    session_start();
    echo "hello";
    if (isset($_GET['logout'])) {
        session_destroy();
        header("location:index.php");
    }

?>
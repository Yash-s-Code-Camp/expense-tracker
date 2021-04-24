<?php

    session_start();
    if (!isset($_SESSION['email'])) {
        header("location:login.php");
    }
    else{
        echo "<h1>".$_SESSION['email']."</h1>";
    }


    if (isset($_POST['logout'])) {
        session_destroy();
        header("location:index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>
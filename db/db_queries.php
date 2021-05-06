<?php

    $user_table_query = 
    "CREATE TABLE IF NOT EXISTS `users` (
        `id` int(8) AUTO_INCREMENT PRIMARY KEY,
        `full_name` varchar(30) NOT NULL,
        `username` varchar(30) NOT NULL,
        `email` varchar(30) NOT NULL UNIQUE,
        `password` varchar(30) NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

   $category_table_query = 
    "CREATE TABLE IF NOT EXISTS `categories` (
        `id` int(8) AUTO_INCREMENT PRIMARY KEY,
        `name` varchar(30) NOT NULL
    )";
    
    $budget_table_query = 
    "CREATE TABLE IF NOT EXISTS `budget` (
        `id` int(8) AUTO_INCREMENT PRIMARY KEY,
        `user_id` int(8) REFERENCES `users`(`id`), 
        `total_budget` decimal(10,2) NOT NULL,
        `total_expense` decimal(10,2) NOT NULL
    )";    // user_id (R, 1 - 2 - M ) 

    $expense_table_query =
    "CREATE TABLE IF NOT EXISTS `expense` (
        `id` int(8) AUTO_INCREMENT PRIMARY KEY,
        `budget_id` int(8) REFERENCES `budget`(`id`), 
        `category_id` int(8) REFERENCES `categories`(`id`), 
        `expense` decimal(10,2) NOT NULL,
        `date` date  NOT NULL       
    )";     // user_id (R, 1 - 2 - M ) 
            // budget_id (R, M - 2 - M)
            // category_id (R, M - 2 - M)

    if (!mysqli_query($conn, $user_table_query)) {
        echo "Error while creating user table";
    }
    if (!mysqli_query($conn, $category_table_query)) {
        echo "Error while creating Category table";
    }
    if (!mysqli_query($conn, $budget_table_query)) {
        echo "Error while creating budget table";
    }
    if (!mysqli_query($conn, $expense_table_query)) {
        echo "Error while creating expense table";
    }
    echo mysqli_error($conn);
?>
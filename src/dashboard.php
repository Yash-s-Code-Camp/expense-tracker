<?php

session_start();
if (!isset($_SESSION['email'])) {
    header("location:login.php");
} else {
    echo "<h1>" . $_SESSION['email'] . "</h1>";
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("location:index.php");
}

?>
<div class="container px-5 py-24 mx-auto">
    <div class="flex flex-wrap -m-4 text-center">
        <div class="p-4 sm:w-1/4 w-1/2">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">30K</h2>
            <p class="leading-relaxed">Income</p>
        </div>
        <div class="p-4 sm:w-1/4 w-1/2">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">3K</h2>
            <p class="leading-relaxed">Household</p>
        </div>
        <div class="p-4 sm:w-1/4 w-1/2">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">5K</h2>
            <p class="leading-relaxed">Food</p>
        </div>
        <div class="p-4 sm:w-1/4 w-1/2">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">2K</h2>
            <p class="leading-relaxed">Electricals</p>
        </div>
        <div class="p-4 sm:w-1/4 w-1/2">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">15K</h2>
            <p class="leading-relaxed">Bills</p>
        </div>
        <div class="p-4 sm:w-1/4 w-1/2">
            <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">25K</h2>
            <p class="leading-relaxed">Total Expense</p>
        </div>
    </div>
</div>
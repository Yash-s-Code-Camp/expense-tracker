<?php 
 session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Expense Tracker</title>
  <link rel="stylesheet" href="style.css">
  <script src="main.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
  
  <script src="https://kit.fontawesome.com/43b88d4182.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

</head>

<body>

  <header class="text-gray-600 body-font border-b-2 block md:border-none">
    <div class="container mx-auto flex flex-wrap p-8 flex-col md:flex-row">
      <a href="./index.php" class="flex title-font font-medium items-center text-gray-900 mb-0 pl-4 md:mb-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 5a1 1 0 100 2h1a2 2 0 011.732 1H7a1 1 0 100 2h2.732A2 2 0 018 11H7a1 1 0 00-.707 1.707l3 3a1 1 0 001.414-1.414l-1.483-1.484A4.008 4.008 0 0011.874 10H13a1 1 0 100-2h-1.126a3.976 3.976 0 00-.41-1H13a1 1 0 100-2H7z" clip-rule="evenodd" />
        </svg>
       
        <span class="ml-3 text-xl">Expense Tracker</span>
      </a>
      <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center space-x-5 ">
      <div class="block absolute top-8 right-4 w-20 h-20 md:hidden">
        <button id="hamburger">
          <svg class="h-14 w-14  p-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
        <button class="hidden" id="close">
          <svg class="w-12 h-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
        <div id="nav-links" class="hidden w-full pt-4 md:flex justify-center items-center">
          <a href="./index.php" class="flex flex-col text-center py-2 px-4 rounded hover:bg-indigo-500 hover:text-indigo-50">Home</a>
          <a href="./about.php" class="flex flex-col text-center py-2 px-4 rounded hover:bg-indigo-500 hover:text-indigo-50">About</a>
          <a href="./contact.php" class="flex flex-col text-center py-2 px-2 rounded hover:bg-indigo-500 hover:text-indigo-50">Contact Us</a>
          <?php
            if (isset($_SESSION['email'])) {
          ?>
          <a href="./logout.php?logout=true" class="flex flex-col text-center bg-indigo-500 text-gray-50 border-0 py-1 px-3 focus:outline-none hover:animate-pulse hover:text-indigo-50 rounded text-base mt-4 md:mt-0 uppercase">Logout</a>
          <?php
            }
            else{
          ?>
          <a href="./login.php" class="flex flex-col text-center bg-indigo-500 text-indigo-50 border-0 py-1 px-3 focus:outline-none hover:animate-pulse hover:text-indigo-50 rounded text-base mt-4 md:mt-0 uppercase">Start now</a>
          <?php
            }
          ?>
        </div>
      </nav>

    </div>
  </header>

  
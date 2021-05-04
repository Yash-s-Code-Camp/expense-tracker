<?php
    // include "./layouts/top.php";
    session_start();
    if (!isset($_SESSION['email'])) 
    {
        header("location:login.php");
    }
?>

<div class="h-full w-full border-2 flex">
    <div class="border-2 w-full bg-gray-100">
        <div>
            <?php include "./layouts/top.php"; ?>
        </div>
        <div class="border-2 m-10 w-auto h-auto">
           charts: set height width according to you requirement 
           <canvas id="chart" class="chartjs" width="undefined" height="undefined"></canvas>
        </div>
        <div>
            <h1 class=" mx-10 font-sans font-semibold text-3xl">Categories With Biggest Expense</h1>
        </div>
        <div class="m-10 flex flex-wrap justify-between">
            <div class="rounded-md w-36 flex flex-col my-3 bg-gray-50 shadow-lg ">
                <div class="h-20 w-full px-5 pt-3 text-left text-pink-600">
                    <i class="fa fa-shopping-basket text-5xl"></i>
                </div>
                <div class="px-5 text-sm text-gray-400">
                    Shopping Cost
                </div>
                <div class="px-5 pb-3 text-lg text-gray-500 font-semibold">
                    $ 1200
                </div>
            </div>
            <div class="rounded-md w-36 flex flex-col my-3 bg-gray-50 shadow-lg ">
                <div class="h-20 w-full px-5 pt-3 text-left text-blue-600">
                    <i class="fa fa-tshirt text-5xl"></i>
                </div>
                <div class="px-5 text-sm text-gray-400">
                    Cloths
                </div>
                <div class="px-5 pb-3 text-lg text-gray-500 font-semibold">
                    $ 2500
                </div>
            </div>
            <div class="rounded-md w-36 flex flex-col my-3 bg-gray-50 shadow-lg ">
                <div class="h-20 w-full px-5 pt-3 text-left text-green-600">
                    <i class="fa fa-camera text-5xl"></i>
                </div>
                <div class="px-5 text-sm text-gray-400">
                    Color Camera
                </div>
                <div class="px-5 pb-3 text-lg text-gray-500 font-semibold">
                    $ 3500
                </div>
            </div>
            <div class="rounded-md w-36 flex flex-col my-3 bg-gray-50 shadow-lg ">
                <div class="h-20 w-full px-5 pt-3 text-left text-yellow-600">
                    <i class="fa fa-home text-5xl"></i>
                </div>
                <div class="px-5 text-sm text-gray-400">
                    Home Loan
                </div>
                <div class="px-5 pb-3 text-lg text-gray-500 font-semibold">
                    $ 3000
                </div>
            </div>
            <div class="rounded-md w-36 flex flex-col my-3 bg-gray-50 shadow-lg ">
                <div class="h-20 w-full px-5 pt-3 text-left text-red-600">
                    <i class="fa fa-gifts text-5xl"></i>
                </div>
                <div class="px-5 text-sm text-gray-400">
                    Birthday Gift
                </div>
                <div class="px-5 pb-3 text-lg text-gray-500 font-semibold">
                    $ 1200
                </div>
            </div>
            <div class="rounded-md w-36 flex flex-col my-3 bg-gray-50 shadow-lg ">
                <div class="h-20 w-full px-5 pt-3 text-left text-gray-500">
                    <i class="fa fa-truck text-5xl"></i>
                </div>
                <div class="px-5 text-sm text-gray-400">
                    Pickup Loan
                </div>
                <div class="px-5 pb-3 text-lg text-gray-500 font-semibold">
                    $ 4500
                </div>
            </div>

        </div>
    </div>
    <div class="border-2 w-auto flex flex-col justify-start items-center">
        <div class="ml-36 mx-10 w-30 h-10 mt-12 flex justify-between">
            <svg class="w-6 h-6 text-gray-600 mt-2 mx-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
            <div class="border-2 w-10 h-10 rounded-3xl bg-indigo-500 cursor-pointer"></div>
        </div>
        
        <div class="mt-10 mx-6 w-60 h-auto">
            <label for="categories" class="text-gray-600 text-xl pl-2">Categories</label>
            <div class="mt-5 h-auto w-auto flex justify-center pl-1 pr-2 border-b-2">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <label for="household" class="text-gray-800 text-md ml-1 pt-1">Household</label>
                <h5 class="pt-0.5 text-xl ml-24">3K</h5>    
            </div>
            
            <div class="mt-5 pr-2 pl-1 h-auto w-auto flex border-b-2">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"></path>
                </svg>
                <label for="Food" class="text-gray-800 text-md pt-1 ml-1">Food</label>
                <h5 class="pt-0.5 text-xl ml-36">5K</h5>    
            </div>
            <div class="mt-5 h-auto w-auto flex pl-1 pr-2 border-b-2">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <label for="electricals" class="text-gray-800 text-md ml-1 pt-1">Electricals</label>
                <h5 class="pt-0.5 text-xl ml-28">2K</h5>    
            </div>
            <div class="mt-5 pr-2 pl-1 h-auto w-auto flex border-b-2">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                    <label for="bills" class="text-gray-800 text-md pt-1 ml-1">Bills</label>
                <h5 class="pt-0.5 text-xl ml-36">5K</h5>    
            </div>
        </div>
        <div class="mt-10 w-60 h-40 border-2">calendar</div>
    </div>
</div>
<!-- <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-wrap text-center justify-center m-auto">
        <div class="sm:w-1/2 xl:w-1/4 md:w-1/3 m-5  w-full bg-gray-100 rounded shadow-xl text-center">
            <div class="flex flex-col items-center w-fullp-2">
                <div class="flex-1 text-center md:text-center text-gray-600 p-5">
                    <h3 class="text-4xl py-2">30K</h3>
                </div>
                <div class="flex-1 text-center text-gray-600 rounded bg-indigo-400 w-full">
                    <h3 class="font-semi-bold text-2xl py-1 text-gray-50">Income</h3>
                </div>
            </div>
        </div>
        <div class="sm:w-1/2 xl:w-1/4 md:w-1/3 m-5  w-full bg-gray-50 rounded shadow-xl text-center">
            <div class="flex flex-col items-center w-fullp-2">
                <div class="flex-1 text-center md:text-center text-gray-600 p-5">
                    <h3 class="text-4xl py-2">3K</h3>
                </div>
                <div class="flex-1 text-center text-gray-600 rounded bg-indigo-400 w-full">
                    <h3 class="font-semi-bold text-2xl py-1 text-gray-50">Household</h3>
                </div>
            </div>
        </div>
        <div class="sm:w-1/2 xl:w-1/4 md:w-1/3 m-5  w-full bg-gray-50 rounded shadow-xl text-center">
            <div class="flex flex-col items-center w-fullp-2">
                <div class="flex-1 text-center md:text-center text-gray-600 p-5">
                    <h3 class="text-4xl py-2">5K</h3>
                </div>
                <div class="flex-1 text-center text-gray-600 rounded bg-indigo-400 w-full">
                    <h3 class="font-semi-bold text-2xl py-1 text-gray-50">Food</h3>
                </div>
            </div>
        </div>
        <div class="sm:w-1/2 xl:w-1/4 md:w-1/3 m-5  w-full bg-gray-50 rounded shadow-xl text-center">
            <div class="flex flex-col items-center w-fullp-2">
                <div class="flex-1 text-center md:text-center text-gray-600 p-5">
                    <h3 class="text-4xl py-2">2K</h3>
                </div>
                <div class="flex-1 text-center text-gray-600 rounded bg-indigo-400 w-full">
                    <h3 class="font-semi-bold text-2xl py-1 text-gray-50">Electricals</h3>
                </div>
            </div>
        </div>
        <div class="sm:w-1/2 xl:w-1/4 md:w-1/3 m-5  w-full bg-gray-50 rounded shadow-xl text-center">
            <div class="flex flex-col items-center w-fullp-2">
                <div class="flex-1 text-center md:text-center text-gray-600 p-5">
                    <h3 class="text-4xl py-2">15K</h3>
                </div>
                <div class="flex-1 text-center text-gray-600 rounded bg-indigo-400 w-full">
                    <h3 class="font-semi-bold text-2xl py-1 text-gray-50">Bills</h3>
                </div>
            </div>
        </div>
        <div class="sm:w-1/2 xl:w-1/4 md:w-1/3 m-5  w-full bg-gray-50 rounded shadow-xl text-center">
            <div class="flex flex-col items-center w-fullp-2">
                <div class="flex-1 text-center md:text-center text-gray-600 p-5">
                    <h3 class="text-4xl py-2">25K</h3>
                </div>
                <div class="flex-1 text-center text-gray-600 rounded bg-indigo-400 w-full">
                    <h3 class="font-semi-bold text-2xl py-1 text-gray-50">Total Expense</h3>
                </div>
            </div>
        </div>

        <div class="sm:w-1/2 xl:w-1/4 md:w-1/3 m-5  w-full bg-gray-50 rounded shadow-xl text-center">
            <div class="flex flex-col items-center w-full p-2">
                <canvas id="chart" class="chartjs" width="undefined" height="undefined"></canvas>
            </div>
        </div>
    </div>
</div>-->

<!-- <script>
    new Chart(document.getElementById("chart"), {
        "type": "bar",
        "data": {
            "labels": ["Jan", "Feb", "Mar", "Apr"],
            "color" : 'red',
            "datasets": [{
                
                "data": [5, 15, 10, 30],
                "type": "line",
                "fill": false, 
                "borderColor": "rgba(99, 102, 241)"
            }]
        },
        "options": {
            "scales": {
                "yAxes": [{
                    "ticks": {
                        "beginAtZero": true,
                        "fontColor": "rgba(31, 41, 55)",
                        "stepSize": 100,   
                        "display":false,

                    },
                    "gridLines": {
                        "display":false,
                        "drawBorder": false,
                    }
                }],
                "xAxes": [{
                    "ticks": {
                        "fontColor": "rgba(31, 41, 55)",
                        
                    },
                    
                    "gridLines": {
                        "display":false,
                        "drawBorder": false,
                        
                    }
                }],
            },
            "legend": {
                "display": false
            },
         
        }
    });
</script> -->
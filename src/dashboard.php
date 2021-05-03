<?php
include "./layouts/top.php";
if (!isset($_SESSION['email'])) {
    header("location:login.php");
}



?>

<div class="container px-5 py-24 mx-auto">
    <div class="flex flex-wrap text-center justify-center m-auto">

        <div class="sm:w-1/2 xl:w-1/4 md:w-1/3 m-5  w-full bg-gray-50 rounded shadow-xl text-center">
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
            <div class="flex flex-col items-center w-fullp-2">
                <canvas id="chart" class="chartjs" width="undefined" height="undefined"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    new Chart(document.getElementById("chart"), {
        "type": "bar",
        "data": {
            "labels": ["January", "February", "March", "April"],
            "color" : 'red',
            "datasets": [{
                "label": "Expense History",
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
                        "beginAtZero": true
                    },
                    "gridLines": {
                        "display":false
                    }
                }],
                "xAxes": [{
                    "gridLines": {
                        "display":false
                    }
                }],
            }
        }
    });
</script>
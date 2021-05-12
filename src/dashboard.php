<?php include "./layouts/top.php";
if (!isset($_SESSION['email'])) {
    header("location:login.php");
}

    if (isset($_POST['add_expense'])) {
        $title = $_POST['expense_title'];
        $amount = $_POST['amount'];
        $category = $_POST['caategory'];
        $desc = $_POST['description'];

        //$query = "INSERT INTO"
    }

?>

<div class=" w-full border-2 flex bg-gray-100 relative">
    <div class="border-r-2 w-full bg-gray-100">
        <div class=" m-10 rounded-md bg-white shadow-md w-auto h-auto">
            <div class="flex flex-col md:flex-row flex-wrap w-full">
                <div class="flex flex-col w-full  lg:w-2/3 ">
                    <div class="flex flex-wrap w-full">
                        <div class="w-1/3 p-5 text-center">
                            <i class="fas fa-wallet fa-lg w-full text-red-600 p-4 "></i>
                            <p class="font-semibold text-2xl text-2x p-2">$ 12000</p>
                            <p class="text-red-600 font-semibold p-2">Expenses</p>
                        </div>
                        <div class="w-1/3 p-5 text-center">
                            <i class="fas fa-donate fa-lg w-full text-blue-600 p-4"></i>
                            <p class="font-semibold text-2xl text-2x p-2">$ 12000</p>
                            <p class="text-blue-600 font-semibold p-2">Expenses & Revenues</p>
                        </div>
                        <div class="w-1/3 p-5 text-center">
                            <i class="fas fa-wallet fa-lg w-full text-green-600 p-4"></i>
                            <p class="font-semibold text-2xl p-2">$ 12000</p>
                            <p class="text-green-600 font-semibold p-2">Revenues</p>
                        </div>
                    </div>
                    <div class="">
                        <canvas id="chart" class="chartjs" width="undefined" height="undefined"></canvas>
                    </div>
                </div>
                <div class="w-full lg:w-1/3">
                    <div class="flex flex-col  flex-wrap w-full ">
                        <div class="px-2 py-5 text-2xl font-medium">Budget</div>
                        <div class="h-52 ">
                            <canvas id="chart-doughnut" class="chartjs" width="undefined" height="undefined"></canvas>

                        </div>
                        <div class="px-2 py-5 text-md font-medium text-center flex space-x-1 ">
                            <div class="w-1/2">
                                <p class="text-xl py-1">$35000</p>
                                <p class="text-gray-500">Monthly Limit</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-xl py-1">$3000</p>
                                <p class="text-gray-500">Remaining</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="flex  w-full justify-between">
            <h1 class=" mx-10 font-sans font-semibold text-3xl">Categories With Biggest Expense</h1>
            <button type="button" class="bg-indigo-500 py-2 px-4 text-white text-semibold rounded-md my-2 mx-10" id="btnAddExpense" onclick="openModal()">Add Expense</button>
        </div>




        <div class="m-10 flex flex-wrap justify-between">
            <div class="rounded-md w-36 flex flex-col my-3 bg-gray-50 shadow-lg ">
                <div class="h-20 w-full px-5 pt-3 text-left text-gray-700">
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
                <div class="h-20 w-full px-5 pt-3 text-left text-gray-700">
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
                <div class="h-20 w-full px-5 pt-3 text-left text-gray-700">
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
                <div class="h-20 w-full px-5 pt-3 text-left text-gray-700">
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
                <div class="h-20 w-full px-5 pt-3 text-left text-gray-700">
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
                <div class="h-20 w-full px-5 pt-3 text-left text-gray-700">
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
    <div class="border-t-none border-l-4 w-auto flex flex-col justify-start items-center ">
        <div class="ml-36 mx-10 w-30 h-10 mt-12 flex justify-between">
            <svg class="w-6 h-6 text-gray-600 mt-2 mx-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
            <div class="border-2 w-10 h-10 rounded-3xl bg-indigo-500 cursor-pointer"></div>
        </div>

        <div class="mt-10 mx-6 w-60 h-auto">
            <label for="categories" class="text-gray-800 text-xl font-bold pl-2">Categories</label>
            <div class="mt-5 h-auto w-auto flex justify-start pl-1 pr-2 border-b-2">
                <i class="fas fa-home fa-lg text-gray-700 py-3 px-3 mb-2 ml-1 text-center"></i>
                <!-- <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg> -->
                <label for="household" class="text-gray-800 text-md ml-3 pt-1">Household</label>
                <h5 class="pt-0.5 text-xl ml-16">3K</h5>
            </div>

            <div class="mt-5 h-auto w-auto flex justify-start pl-1 pr-2 border-b-2">
                <i class="fas fa-utensils fa-lg text-gray-700 px-4 py-3 mb-2 ml-1 mr-2 text-center"></i>
                <!-- <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"></path>
                </svg> -->
                <label for="Food" class="text-gray-800 text-md pt-1 ml-1">Food</label>
                <h5 class="pt-0.5 text-xl ml-24 pl-2">5K</h5>
            </div>
            <div class="mt-5 h-auto w-auto flex pl-1 pr-2 border-b-2">
                <i class="fas fa-bolt fa-lg text-gray-700 px-5 py-3 mb-2 ml-1 mr-2 text-center"></i>
                <!-- <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg> -->
                <label for="electricals" class="text-gray-800 text-md ml-0 pt-1">Electricals</label>
                <h5 class="pt-0.5 text-xl ml-16 pl-2">2K</h5>
            </div>
            <div class="mt-5 pr-2 pl-1 h-auto w-auto flex border-b-2">
                <i class="fas fa-file-invoice fa-lg text-gray-700 px-5 py-3 mb-2 ml-1 mr-2 text-center"></i>
                <!-- <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg> -->
                <label for="bills" class="text-gray-800 text-md pt-1 ml-0">Bills</label>
                <h5 class="pt-0.5 text-xl ml-28 ">5K</h5>
            </div>
        </div>
        <div class="mt-5 h-auto w-auto flex pl-1 pr-2 border-b-2">
            <a href="./add_category.php" class="bg-indigo-500 text-white w-full py-2 px-3 rounded-md">Add Category</a href="./add_category.php">
        </div>

        <div class="w-60 h-auto mt-10">
            <label for="categories" class="text-gray-800 text-xl font-bold">Calendar</label>
            <input type="date" data-date-inline-picker="true" class="w-60 mt-5" />
        </div>
    </div>

    <!-- Modal -->
    <div id="add_expense_modal" class="w-full h-full flex justify-center items-center z-10 bg-gray-50 absolute bg-opacity-70  hidden  top-0 left-0">
        <div class="bg-gray-300 relative">
            <form action="#" method="post">
                <div class=" flex flex-col  justify-center items-center space-y-4 opacity-100">
                    <div class="  bg-gray-100 rounded-lg p-8 flex flex-col  mt-10 md:mt-0">
                        <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Add Expense</h2>

                        

                        <div class="flex relative mb-4 space-x-2">
                        <div class="relative mb-4 w-1/2">
                            <label for="expense_title" class="leading-7 text-sm text-gray-600">Expense Title</label>
                            <input type="text" id="expense_title" name="expense_title" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                        </div>
                            <div class="relative mb-4 w-1/2">
                                <label for="category" class="leading-7 text-sm text-gray-600">Category</label>
                                <input type="text" id="category" name="category" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                            </div>  

                        </div>

                        <div class="flex relative mb-4 space-x-2">
                            <div class="relative mb-4 w-1/2">
                                <label for="date" class="leading-7 text-sm text-gray-600">Date</label>
                                <input type="date" id="date" name="date" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                            </div>
                            <div class="relative mb-4 w-1/2">
                                <label for="amount" class="leading-7 text-sm text-gray-600">Amount</label>
                                <input type="number" id="amount" name="amount" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                            </div>

                        </div>

                        <div class="relative mb-4">
                            <label for="description" class="leading-7 text-sm text-gray-600">Description</label>
                            <input type="text" id="description" name="description" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                        </div>

                        <button type="submit" name="add_expense" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">ADD</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    //const btnAddExpense = document.querySelector("#btnAddExpense") 

    let openModal = ()=>{
        let modal = document.querySelector("#add_expense_modal")
        modal.classList.remove("hidden")
    }

</script>


<script>
    new Chart(document.getElementById("chart"), {
        "type": "bar",
        "data": {
            "labels": ["Jan", "Feb", "Mar", "Apr"],
            "color": 'red',
            "datasets": [{

                "data": [5, 15, 10, 30],
                "type": "line",
                "fill": false,
                "borderColor": "rgba(99, 102, 241)"
            }]
        },
        "options": {
            "responsive": true,
            "maintainAspectRatio": false,
            "scales": {
                "yAxes": [{
                    "ticks": {
                        "beginAtZero": true,
                        "fontColor": "rgba(31, 41, 55)",
                        "stepSize": 100,
                        "display": false,

                    },
                    "gridLines": {
                        "display": false,
                        "drawBorder": false,
                    }
                }],
                "xAxes": [{
                    "ticks": {
                        "fontColor": "rgba(31, 41, 55)",

                    },

                    "gridLines": {
                        "display": false,
                        "drawBorder": false,

                    }
                }],
            },
            "legend": {
                "display": false
            },

        }
    });

    new Chart(document.getElementById("chart-doughnut"), {
        "type": "doughnut",
        "data": {
            "labels": ["Expense", "Budget"],
            "datasets": [{
                "label": "Expense",
                "data": [10, 40],
                "backgroundColor": [
                    "rgba(37, 99, 235)",
                    "rgba(248, 113, 113)",
                ],
                // "borderColor": [
                // "gray",
                // "gray"
                // ],
                // "borderWidth": [2,2]
            }],

        },
        "options": {
            "responsive": true,
            "maintainAspectRatio": false,
            "legend": {
                "display": false
            },

        }

    });
</script>
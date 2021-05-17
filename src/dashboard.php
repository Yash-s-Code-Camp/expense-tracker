<?php include "./layouts/top.php";
if (!isset($_SESSION['email'])) {
    header("location:login.php");
}
include "../db/db.php";
$sql = "SELECT * FROM `categories`";
$res = mysqli_query($conn, $sql);
$categories = array();
// $icons = array("fa-home","fa-utensils","fa-bolt","fa-file-invoice");
while ($row = mysqli_fetch_row($res)) {
    array_push($categories, $row);
}
if (isset($_POST['add_expense'])) {
    $title = $_POST['expense_title'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $desc = $_POST['description'];
    $date = $_POST['date'];

    $query = "INSERT INTO `expense` (`title`,`category_id`,`expense`,`date`,`description`) VALUES('$title','$category',$amount,'$date','$desc')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Expense added.'); window.location='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error while adding expense.');</script>";
    }
    mysqli_error($conn);
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

        <div class="m-10 flex flex-wrap justify-start">
            <?php  
                $str = "SELECT * FROM `expense` AS e,`categories` AS c WHERE `e`.`category_id` = `c`.`id`";
                $result = mysqli_query($conn,$str);

                while($row = mysqli_fetch_array($result))
                {

            ?>

                    <div class="rounded-md w-36 flex flex-col my-3 mx-4 bg-gray-50 shadow-lg ">
                        <div class="h-20 w-full px-5 pt-3 text-left text-gray-700">
                            <i class="fa <?php echo $row['icon'];?> text-5xl"></i>
                        </div>
                        <div class="px-5 text-sm text-gray-400">
                            <?php echo $row['title']; ?>
                        </div>
                        <div class="px-5 pb-3 text-lg text-gray-500 font-semibold">
                            ₹ <?php echo $row['expense']; ?>
                        </div>
                    </div>

            <?php
                }
            
            ?>

        </div>
    </div>
    <div class="border-t-none border-l-4 w-auto flex flex-col justify-start items-center ">
        <div class="ml-36 mx-10 w-30 h-10 mt-12 flex justify-between">
            <svg class="w-6 h-6 text-gray-600 mt-2 mx-6 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
            <div class="border-2 w-10 h-10 rounded-3xl bg-indigo-500 cursor-pointer"></div>
        </div>

        <div class="mt-10 mx-8 w-72 h-auto">
            <label for="categories" class="text-gray-800 text-xl font-bold pl-2">Categories</label>

            <?php
            // for ($i = 0; $i < count($categories); $i++) {
            //     $id = $categories[$i][0];
            //     $name = $categories[$i][1];
            //     $icon = $categories[$i][2];
                   
                //echo "<option value='$id' >$name</option>";
                $str = "SELECT `icon`,`name`,sum(`expense`) AS total FROM `categories` AS c LEFT JOIN `expense` AS e ON `c`.`id` = `e`.`category_id` GROUP BY `e`.`category_id`";
                $result = mysqli_query($conn,$str);

                

                while($row = mysqli_fetch_array($result))
                {
                    
            ?>

                    <div class="mt-5 h-auto w-full flex justify-between items-center pl-1 pr-2 border-b-2">
                        <div class="w-2/5 flex justify-between items-center">
                            <i class="fas <?php echo $row['icon']; ?> fa-lg text-gray-700 py-3 mb-2 text-center"></i>
                        
                            <label for="name" class="text-gray-800 text-md w-2/5"><?php echo $row['name']; ?></label>
                        </div>
                    

                        <h5 class="pt-0.5 text-xl text-right font-semibold w-2/5">₹ <?= ($row['total'] == null) ? '0' : $row['total'];?></h5>
                    </div>

            <?php
                   
            }
            ?>


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
                                <select name="category" id="category" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-2 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                                    <option value="0">Select Category</option>
                                    <?php
                                    for ($i = 0; $i < count($categories); $i++) {
                                        $id = $categories[$i][0];
                                        $name = $categories[$i][1];
                                        echo "<option value='$id' >$name</option>";
                                    }

                                    ?>

                                </select>
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

    let openModal = () => {
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
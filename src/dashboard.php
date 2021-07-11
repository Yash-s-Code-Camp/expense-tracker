<?php include "./layouts/top.php";
if (!isset($_SESSION['email'])) {
    header("location:login.php");
}
include "../db/db.php";
include './mail.php';

$userId = $_SESSION['userId'];

if (isset($_POST['add_expense'])) {
    $title = $_POST['expense_title'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $desc = $_POST['description'];
    $date = $_POST['date'];
    $today_dt = date("Y-m-d");

    if ($date <= $today_dt) 
    {
        $query = "INSERT INTO `expense` (`title`,`user_id`,`category_id`,`expense`,`date`,`description`) VALUES('$title',$userId,'$category',$amount,'$date','$desc')";
        $result = mysqli_query($conn, $query);
        echo "<script>alert('Expense added.'); window.location='dashboard.php';</script>";
    } 
    else 
    {
        echo "<script>alert('Error while adding expense. Please select date that is less than todays date.');</script>";
        $e = mysqli_error($conn);
    }

}
$current_month = date('m');
// $current_month = 6;

$query = "SELECT `total_budget`,sum(`expense`) as `expense` from `budget` as b LEFT JOIN `expense` as e ON b.user_id = e.user_id and month(date) =  $current_month  and b.user_id = " . $_SESSION['userId'];
$res = mysqli_query($conn, $query);

if (mysqli_num_rows($res) > 0) 
{
    $data = mysqli_fetch_assoc($res);
    $remaining_budget = number_format((float)($data['total_budget'] - $data['expense']), 2, '.', '');

    $remaing_budget_percentage = (100 * $remaining_budget) / $data['total_budget'];
    
    if ($remaing_budget_percentage <= 10) { 
        sendMail($_SESSION['email'],"Expense Alert","you spent 90% or more of your budget.<br> Please spent remaning budget carefully.");
    }
    // print_r($data);
    // echo $_SESSION['userId'];
    $piechart_data = "[".$data['expense']." , $remaining_budget]";
}
else
{
    mysqli_error($conn);
}

?>

<?php 
    $str="SELECT `income` FROM `users` WHERE `email` = '".$_SESSION['email']."'"; 
    $result = mysqli_query($conn,$str); 
    $row = mysqli_fetch_array($result);

    $savings = $row['income'] - $data['total_budget'];
    $net_savings = $savings + $remaining_budget;
?>

<div class=" w-full border-2 flex bg-gray-100 relative">
    <div class="border-r-2 w-full bg-gray-100">
        <div class=" m-10 rounded-md bg-white shadow-md w-auto h-auto">
            <div class="flex flex-col md:flex-row flex-wrap w-full">
                <div class="flex flex-col w-full  lg:w-2/3 ">
                    <div class="flex flex-wrap w-full">
                        <div class="w-1/3 p-5 text-center">
                            <i class="fas fa-wallet fa-lg w-full text-red-600 p-4 "></i>
                            <p class="font-semibold text-2xl text-2x p-2">₹ <?= isset($data['expense']) ? $data['expense'] : 0 ?></p>
                            <p class="text-red-600 font-semibold p-2">Expenses</p>
                        </div>
                        <div class="w-1/3 p-5 text-center">
                            <i class="fas fa-donate fa-lg w-full text-blue-600 p-4"></i>
                            <p class="font-semibold text-2xl text-2x p-2">₹ <?= $net_savings ?></p>
                            <p class="text-blue-600 font-semibold p-2">Savings</p>
                        </div>
                        <div class="w-1/3 p-5 text-center">
                            <i class="fas fa-wallet fa-lg w-full text-green-600 p-4"></i>
                            <p class="font-semibold text-2xl p-2">₹ <?= $data['total_budget'] ?></p>
                            <p class="text-green-600 font-semibold p-2">Budget</p>
                        </div>
                    </div>
                    <div class="">
                        <canvas id="chart" class="chartjs" width="undefined" height="undefined"></canvas>
                    </div>
                </div>
                <div class="w-full lg:w-1/3">
                    <div class="flex flex-col  flex-wrap w-full ">
                        <div class="px-2 py-5 text-2xl font-medium">Budget</div>
                        <div class="h-52 w-full">
                            <canvas id="chart-doughnut" class="chartjs" width="undefined" height="undefined"></canvas>

                        </div>
                        <div class="px-2 py-5 text-md font-medium text-center flex space-x-1 ">
                            <div class="w-1/2">
                                <p class="text-xl py-1">₹ <?= $row['income']; ?></p>
                                <p class="text-gray-500">Monthly Income</p>
                            </div>
                            <div class="w-1/2">
                                <p class="text-xl py-1">₹ <?= $remaining_budget ?></p>
                                <p class="text-gray-500">Remaining Budget</p>
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
            $str = "SELECT * FROM `expense` AS e,`categories` AS c WHERE `e`.`category_id` = `c`.`id` and month(date) =  $current_month and  c.user_id = $userId order by `expense` desc limit 6";
            $result = mysqli_query($conn, $str);

            while ($row = mysqli_fetch_array($result)) {

            ?>

                <div class="rounded-md w-36 flex flex-col my-3 mx-4 bg-gray-50 shadow-lg ">
                    <div class="h-20 w-full px-5 pt-3 text-left text-gray-700">
                        <i class="fa <?php echo $row['icon']; ?> text-5xl"></i>
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
            <div class="border-2 w-10 h-10 rounded-3xl bg-indigo-500 cursor-pointer" onclick="toggleDD('myDropdown')">
                <!-- <i class="fa fa-user fa-fw fa-x"></i> -->
            </div>
            <div class="relative inline-block">
                <button class="drop-button text-white focus:outline-none"> <span class="pr-2"><i class="em em-robot_face"></i></span><svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg></button>
                <div id="myDropdown" class="dropdownlist absolute bg-gray-800 text-white right-0 ml-3 mt-5 p-3 overflow-auto z-30 invisible w-32">
                    <a href="./profile.php" class="p-2  bg-gray-800 hover:bg-gray-500 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-user fa-fw"></i> Profile</a>
                    <a href="#" class="p-2 bg-gray-800 hover:bg-gray-500 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-cog fa-fw"></i> Settings</a>
                    <div class="border border-gray-800"></div>

                </div>
            </div>
        </div>

        <div class="mt-10 mx-8 w-72 h-auto">
            <label for="categories" class="text-gray-800 text-xl font-bold pl-2">Categories</label>

            <?php
            // for ($i = 0; $i < count($categories); $i++) {
            //     $id = $categories[$i][0];
            //     $name = $categories[$i][1];
            //     $icon = $categories[$i][2];

            //echo "<option value='$id' >$name</option>";
            $str = "SELECT `icon`,`name`,sum(`expense`) AS total FROM `categories` AS c LEFT JOIN `expense` AS e on `c`.`id` = `e`.`category_id` and month(e.date) =  $current_month where c.user_id = $userId   group by c.id order by sum(expense) desc";
            $result = mysqli_query($conn, $str);


            while ($row = mysqli_fetch_assoc($result)) {

            ?>

                <div class="mt-5 h-auto w-full flex justify-between items-center pl-1 pr-2 border-b-2">
                    <div class="w-2/5 flex justify-between items-center">
                        <i class="fas <?php echo $row['icon']; ?> fa-lg text-gray-700 py-3 mb-2 text-center"></i>

                        <label for="name" class="text-gray-800 text-md w-2/5"><?php echo $row['name']; ?></label>
                    </div>


                    <h5 class="pt-0.5 text-xl text-right font-semibold w-2/5">₹ <?= ($row['total'] == null) ? '0' : $row['total']; ?></h5>
                </div>

            <?php

            }
            ?>


        </div>
        <div class="mt-5 h-auto w-auto flex pl-1 pr-2 border-b-2">
            <a href="./add_category.php" class="bg-indigo-500 text-white w-full py-2 px-3 rounded-md">Add Category</a href="./add_category.php">
        </div>

        <div class="w-60 h-auto mt-10">
            <div id="calendar">

            </div>

        </div>
    </div>

    <!-- Modal -->
    <div id="add_expense_modal" class="w-full h-full flex justify-center items-center z-10 bg-gray-50 absolute bg-opacity-70  hidden  top-0 left-0 ">
        <div class="bg-gray-300 relative">
            <form action="#" method="post" id="add-expense-form">
                <div class=" flex flex-col  justify-center items-center space-y-4 opacity-100">
                    <div class="  bg-gray-100 rounded-lg p-8 flex flex-col  mt-10 md:mt-0">
                        <div class="flex justify-between w-full">
                            <div>
                                <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Add Expense</h2>
                            </div>
                            <div class="px-5 text-left text-gray-700">
                                <span id="btn-close" class="cursor-pointer"><i class="fa fa-times text-3xl"></i></span>
                            </div>
                        </div>

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

                                    $sql = "SELECT * FROM `categories` where `user_id` = " . $_SESSION['userId'];
                                    $res = mysqli_query($conn, $sql);
                                    $categories = array();
                                    // $icons = array("fa-home","fa-utensils","fa-bolt","fa-file-invoice");
                                    while ($row = mysqli_fetch_row($res)) {
                                        array_push($categories, $row);
                                    }

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

<!-- Line chart data -->

<?php
$query = "SELECT DATE_FORMAT(date, '%M') as `month` ,SUM(expense) as `expense` FROM expense where user_id = " . $_SESSION['userId'] . " GROUP BY MONTH(date), YEAR(date) DESC";
$res = mysqli_query($conn, $query);
if (mysqli_num_rows($res) > 0) {
    $month_lbl = "[";
    $expenses = "[";
    while ($r = mysqli_fetch_assoc($res)) {
        $month_lbl .= "\"" . $r['month'] . "\",";
        $expenses .= "\"" . $r['expense'] . "\",";
    }
    $month_lbl .= "]";
    $expenses .= "]";

    // print_r($month);
}

?>


<script src="https://cdn.jsdelivr.net/npm/color-calendar/dist/bundle.js">
</script>
<script>
    function toggleDD(myDropMenu) {
        document.getElementById(myDropMenu).classList.toggle("invisible");
    }

    let modal = document.querySelector("#add_expense_modal")
    const close = document.querySelector("#btn-close")

    close.addEventListener("click", () => {
        modal.classList.add('hidden')
        document.getElementById("add-expense-form").reset()
    })
    let openModal = () => {
        modal.classList.remove("hidden")
    }
</script>


<script>
    new Chart(document.getElementById("chart"), {
        "type": "bar",
        "data": {
            "labels": <?= $month_lbl ?>,
            "color": 'red',
            "datasets": [{

                "data": <?= $expenses ?>,
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
                        "max": 60000,

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
            "labels": ["Expense", "Remaining Budget"],
            "datasets": [{
                "label": "Expense",
                "data": <?= $piechart_data ?>,
                "backgroundColor": [
                    "rgba(248, 113, 113)",
                    "rgba(37, 99, 235)",
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


    // calender

    new Calendar({
        id: '#calendar',
        calendarSize: 'small',
        dateChanged: (date, month) => {
            d = Date.parse(date)
        }
    })
</script>
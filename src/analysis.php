<?php
include "./layouts/top.php";
include "../db/db.php";

if (!isset($_SESSION['email'])) {
    header("location:login.php");
}
$userId = $_SESSION['userId'];

if (isset($_GET['input_year'])) {
    $input_year = $_GET['input_year'];
    echo "<script>activeTab('panel-2','tab-2')</script>";
}
else if (isset($_GET['input_month'])) {
    $input_month = $_GET['input_month'];
    echo "<script>activeTab('panel-1','tab-1')</script>";
}
else{
    $input_month = date('Y-m');
}

?>



<?php
if (isset($_GET['btnAnalyseMonth']) || isset($input_month)) {

    // $date = $_GET['input_month'];

    $q1 = "SELECT `total_budget`,sum(`expense`) as `expense` from `budget` as b LEFT JOIN `expense` as e ON b.user_id = e.user_id and date_format(e.date,'%Y-%m') = '$input_month'  and b.user_id = " . $_SESSION['userId'];

    $q2 = "SELECT `icon`,`name`,sum(`expense`) AS total FROM `categories` AS c LEFT JOIN `expense` AS e on `c`.`id` = `e`.`category_id` and DATE_FORMAT(e.date,'%Y-%m') = '$input_month' where c.user_id = $userId   group by c.id order by sum(expense) desc";

    $q3 = "SELECT * from expense as e, categories as c where e.category_id = c.id and DATE_FORMAT(e.date,'%Y-%m') = '$input_month'  and e.user_id = $userId order by e.date, expense desc";
}

if (isset($_GET['btnAnalyseYear'])) {
    // $date = $_GET['input_year'];

    $q1 = "SELECT `total_budget`,sum(`expense`) as `expense` from `budget` as b LEFT JOIN `expense` as e ON b.user_id = e.user_id and date_format(e.date,'%Y') = '$input_year'  and b.user_id = " . $_SESSION['userId'];

    $q2 = "SELECT `icon`,`name`,sum(`expense`) AS total FROM `categories` AS c LEFT JOIN `expense` AS e on `c`.`id` = `e`.`category_id` and DATE_FORMAT(e.date,'%Y') = '$input_year' where c.user_id = $userId   group by c.id order by sum(expense) desc";

    $q3 = "SELECT * from expense as e, categories as c where e.category_id = c.id and DATE_FORMAT(e.date,'%Y') = '$input_year'  and e.user_id = $userId order by e.date, expense desc";
}

$res1 = mysqli_query($conn, $q1);
if (mysqli_num_rows($res1) > 0) {
    $data = mysqli_fetch_assoc($res1);
    $remaining_budget = number_format((float)($data['total_budget'] - $data['expense']), 2, '.', '');
    $piechart_data = "[" . $data['expense'] . " , $remaining_budget]";
} else {
    mysqli_error($conn);
}
?>

<div class="bg-white">
    <nav class="tabs flex flex-row justify-center">
        <!-- <button data-target="panel-1" class="tab active-tab text-blue-500 py-4 px-6 block focus:outline-none hover:text-blue-500 border-b-2 font-medium border-blue-500">
            Date wise
        </button>
        <button data-target="panel-2" class="tab text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none">
            By Date span
        </button> -->
        <button id="tab-1"  class="tab py-4 px-6 block text-blue-500 border-blue-500  border-b-2 hover:text-blue-500 focus:outline-none " onclick="activeTab('panel-1','tab-1')">
            Montly
        </button>
        <button id="tab-2"  class="tab text-gray-600 py-4 px-6 block hover:text-blue-500 focus:outline-none" onclick="activeTab('panel-2','tab-2')">
            Yearly
        </button>
    </nav>
</div>

<div id="panels" class="py-2">
    <div class=" py-6 flex justify-center">

        <div id="panel-1" class="panel">
            <form action="" method="get">
                <input type="month" id="month_input" name="input_month" class="input bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 p-0.5 px-3 leading-8 transition-colors duration-200 ease-in-out w-60" value="<?= isset($input_month) ? $input_month : "" ?>">
                <button type="submit" name="btnAnalyseMonth" class="text-white bg-indigo-500 border-0 py-1   px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Analyse</button>
            </form>
        </div>
        <div id="panel-2" class="panel hidden">
            <form action="" method="get">
                <input type="number" id="year_input" name="input_year" class="input bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 p-0.5 px-3 leading-8 transition-colors duration-200 ease-in-out  w-60" max="2999" min="1950" placeholder="yyyy" value="<?= isset($input_year) ? $input_year : "" ?>">
                <button type="submit" name="btnAnalyseYear" class="text-white bg-indigo-500 border-0 py-1   px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Analyse</button>
            </form>
        </div>


    </div>

</div>
<div class="flex space-x-2 px-4 pb-16">
    <div class="w-1/3">
        <div class=" w-full">
            <div class="rounded-md bg-white  shadow-md w-auto h-auto">
                <div class="flex flex-col flex-wrap w-full">
                    <div class="flex flex-col w-full">
                        <div class="flex flex-wrap w-full justify-center">
                            <div class="w-1/3 px-5 text-center shadow-md">
                                <i class="fas fa-wallet fa-lg w-full text-red-600 p-4 "></i>
                                <p class="font-semibold text-xl text-2x p-2">₹ <?= isset($data['expense']) ? $data['expense'] : 0 ?></p>
                                <p class="text-red-600 font-semibold p-2">Expenses</p>
                            </div>
                            <!-- <div class="w-1/3 px-5 text-center">
                                <i class="fas fa-donate fa-lg w-full text-blue-600 p-4"></i>
                                <p class="font-semibold text-xl text-2x p-2">₹ <?= isset($remaining_budget) ? $remaining_budget : 0 ?></p>
                                <p class="text-blue-600 font-semibold p-2">Savings</p>
                            </div>
                            <div class="w-1/3 px-5 text-center">
                                <i class="fas fa-wallet fa-lg w-full text-green-600 p-4"></i>
                                <p class="font-semibold text-xl p-2">₹ <?= isset($data['total_budget']) ? $data['total_budget'] : 0 ?></p>
                                <p class="text-green-600 font-semibold p-2">Budget</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="flex flex-col  flex-wrap w-full ">
                            <div class="px-2 py-5 text-2xl font-medium">Category wise expense</div>
                            <div class="w-full px-6 mb-4">
                                <?php

                                $res2 = mysqli_query($conn, $q2);


                                while ($row = mysqli_fetch_assoc($res2)) {

                                ?>

                                    <div class="mt-5 h-auto w-full flex justify-between items-center px-3 border-b-2">
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

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="w-2/3">
        <div class="overflow-x-auto">
            <div class="flex items-center  font-sans overflow-hidden">
                <div class="w-full lg:w-6/6 px-2 ">
                    <div class="bg-white shadow-md rounded">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">Title</th>
                                    <th class="py-3 px-6 text-left">Expense</th>
                                    <th class="py-3 px-6 text-center">Category</th>
                                    <th class="py-3 px-6 text-center">Date</th>
                                    <!-- <th class="py-3 px-6 text-center">Description</th> -->
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                                <?php

                                //echo $query;
                                $res3 = mysqli_query($conn, $q3);

                                while ($r = mysqli_fetch_assoc($res3)) {
                                    $date = date_create($r['date']);

                                ?>
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left whitespace-nowrap font-semibold">
                                            <?= $r['title'] ?>
                                        </td>
                                        <td class="py-3 px-6 text-left font-semibold">
                                            <?= $r['expense'] ?>
                                        </td>
                                        <td class="py-3 px-6 text-center font-semibold">
                                            <?= $r['name'] ?>
                                        </td>
                                        <td class="py-3 px-6 text-center font-semibold">
                                            <?= date_format($date, "d-m-Y") ?>
                                        </td>
                                    </tr>

                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    function activeTab(panelId,tabId) {
        let panel = document.querySelector("#" + panelId)
        let tab = document.querySelector("#" + tabId)

        let otherPanels = document.querySelectorAll('.panel')
        let otherTabs = document.querySelectorAll('.tab')

        for (let i = 0; i < otherPanels.length; i++) {
            otherPanels[i].classList.add('hidden')
        }
        panel.classList.remove('hidden')

        for (let i = 0; i < otherTabs.length; i++) {
            otherTabs[i].classList.add('text-gray-500')
            otherTabs[i].classList.remove('text-blue-500', 'border-blue-500', 'border-b-2')
        }
        tab.classList.add('text-blue-500', 'border-blue-500', 'border-b-2')
        tab.classList.remove('text-gray-500')

    }
</script>

<?php
include "./layouts/bottom.php";

if (isset($_GET['input_year'])) {
    $input_year = $_GET['input_year'];
    echo "<script>activeTab('panel-2','tab-2')</script>";
}
if (isset($_GET['input_month'])) {
    $input_month = $_GET['input_month'];
    echo "<script>activeTab('panel-1','tab-1')</script>";
}
?>
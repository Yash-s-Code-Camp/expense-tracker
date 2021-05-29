<?php include "./layouts/top.php"; ?>

<?php
include '../db/db.php';

if (!isset($_SESSION['email'])) {
  header("location:login.php");
}
?>
<?php
    $query = "SELECT * FROM `users` as u,`budget` as b where u.id = b.user_id and `email` = '".$_SESSION['email'] ."'";
    $res = mysqli_query($conn,$query);
    
    if (mysqli_num_rows($res) > 0) {
        $data = mysqli_fetch_assoc($res);
    }
    else{
        echo mysqli_error($conn);
    }

?>

<?php
    if (isset($_POST['update'])) {
        $name = $_POST['fullname'];
        $income = $_POST['income'];
        $email = $_POST['email'];
        $budget = $_POST['budget'];

        $query = "UPDATE `users` as u,`budget` as b set `full_name`= '$name' , `income`= '$income', `total_budget` = $budget where u.id = b.user_id and `email` = '$email';";
        $res = mysqli_query($conn,$query);
        
        if ($res) {
            $error = 0;
        }
    }
?>

<form action="#" method="post">
  <div class=" flex flex-col px-24 lg:px-64  py-10 justify-center items-center space-y-4">
    <div class="lg:w-3/6  bg-gray-100 rounded-lg p-8 flex flex-col  mt-10 md:mt-0">
      <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Profile</h2>

      <div class="relative mb-4">
        <label for="text" class="leading-7 text-sm text-gray-600">Full Name</label>
        <input type="text" id="fullname" name="fullname" value="<?= $data['full_name']?>" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" autofocus required>
      </div>
      <div class="relative mb-4">
        <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
        <input type="email" id="email" name="email" value="<?= $data['email']?>" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required readonly>
      </div>
      <div class="relative mb-4">
        <label for="text" class="leading-7 text-sm text-gray-600">Income</label>
        <input type="text" id="income" name="income" value="<?= $data['income']?>" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" autofocus required>
      </div>
      <div class="relative mb-4">
        <label for="text" class="leading-7 text-sm text-gray-600">Budget</label>
        <input type="text" id="budget" name="budget" value="<?= $data['total_budget'] ?>" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" autofocus required>
      </div>
      
      <button type="submit" name="update" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Update Profile</button>

      <div id="alert" class=" mt-4  px-4 py-3 rounded relative <?= (($error == 0) ? "bg-green-100  border-green-400 text-green-700" : "bg-red-100  border-red-400 text-red-700"); ?> <?= (isset($error) ? '' : 'hidden' ) ?> <?= (isset($error) ? '' : 'hidden' ) ?> " role="alert">
        <strong class="font-semibold"><?= ($error == 0)? "Profile has been updated succesfully!" : "Passwords are not matching!" ?></strong>
        
      </div>

    </div>
  </div>
</form>


<?php include "./layouts/bottom.php"; ?>
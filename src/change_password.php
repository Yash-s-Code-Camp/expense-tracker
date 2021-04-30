<?php 
  include "./layouts/top.php";
  include "../db/db.php";
  
  if (!isset($_COOKIE['otp']) && !isset($_COOKIE['otp_verification'])) {
    header("Location: index.php");
  }


  if (isset($_POST['change_pwd'])) {

    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password == $confirm_password) {
      $query = "UPDATE `users` SET `password` = '$password' WHERE `email` = '". $_COOKIE['useremail'] ."'";
      $res = mysqli_query($conn,$query);

      if ($res) {
        setcookie('otp','', time()-300);
        setcookie('useremail','', time()-300);
        setcookie('otp_verification','', time()-300);


        //sleep(5);
        header("Refresh:5; url=login.php");
        $error = 0;
      }
      else{
        echo mysqli_error($conn);
      }
    }
    else {
      $error = 1;
    }
  }

?>

<form action="#" method="post">
  <div class=" flex flex-col px-24 lg:px-64  py-24 justify-center items-center space-y-4">
    <div class="lg:w-2/6  bg-gray-100 rounded-lg p-8 flex flex-col  mt-10 md:mt-0">
      <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Change Password</h2>

      <div class="relative mb-4">
        <label for="password" class="leading-7 text-sm text-gray-600">Type New Password</label>
        <input type="password" id="password" name="password" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
      </div>
      <div class="relative mb-4">
        <label for="password" class="leading-7 text-sm text-gray-600">Re-type New Password</label>
        <input type="password" id="confirm_password" name="confirm_password" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
      </div>
      <button type="submit" name="change_pwd" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Change Password</button>

      <div id="alert" class=" mt-4  px-4 py-3 rounded relative <?= (($error == 0) ? "bg-green-100  border-green-400 text-green-700" : "bg-red-100  border-red-400 text-red-700"); ?> <?= (isset($error) ? '' : 'hidden' ) ?> <?= (isset($error) ? '' : 'hidden' ) ?> " role="alert">
        <strong class="font-semibold"><?= ($error == 0)? "Password has been updated succesfully!" : "Passwords are not matching!" ?></strong>
        
      </div>

    </div>
  </div>
</form>

<?php include "./layouts/bottom.php"; ?>

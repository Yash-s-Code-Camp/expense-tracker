<?php 
  include "./layouts/top.php";
  
  if (!isset($_COOKIE['otp'])) {
    header("Location: index.php");
  }

  if (isset($_POST['receive_otp'])) {
    $otp = $_POST['otp'];

    if ($otp == $_COOKIE['otp']) {
      setcookie('otp_verification','Done', time()+300);
      header("Location: change_password.php");
    }
    else {
      $error = 1;
    }
  }

?>



<form action="#" method="post">
<div class=" flex flex-col px-24 lg:px-64  py-24 justify-center items-center space-y-4">
  <div class="lg:w-2/6  bg-gray-100 rounded-lg p-8 flex flex-col  mt-10 md:mt-0">
    <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Reset Password</h2>
    
      <div class="relative mb-4">
        <label for="otp" class="leading-7 text-sm text-gray-600">Enter OTP</label>
        <input type="text" id="otp" name="otp" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
      </div>
      
      <button type="submit" name="receive_otp" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Next</button>
      <div id="alert" class="bg-red-100 border border-red-400 mt-4 text-red-700 px-4 py-3 rounded relative <?= (isset($error) ? '' : 'hidden' ) ?> " role="alert">
        <strong class="font-semibold">Incorrect OTP!</strong>
        
      </div>          
  </div>
</div>
</form>

<?php include "./layouts/bottom.php"; ?>

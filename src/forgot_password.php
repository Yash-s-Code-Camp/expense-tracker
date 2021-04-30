<?php include "./layouts/top.php"; ?>

<?php
  include "../db/db.php";
  if (isset($_POST['send_otp'])) {
    $query = "SELECT * from `users` WHERE email = '" . $_POST['email'] . "'";
    $res = mysqli_query($conn,$query);

    if (mysqli_num_rows($res) > 0) {
      include "./mail.php";


      $otp = rand(1000,9999);
      //setcookie('otp',$otp, time()+300);

      $to = $_POST['email'];
      $subject = "Forgot Password";
      $body = "Your one time password is $otp<br>OTP will expire in next 5 minutes.";
      
      if (sendMail($to,$subject,$body)) {
        //TODO
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
    <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Forgot Password</h2>
    
      <div class="relative mb-4">
        <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
        <input type="email" id="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
      </div>
      
      <button type="submit" name="send_otp" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Send OTP</button>
      <div id="alert" class="bg-red-100 border border-red-400 mt-4 text-red-700 px-4 py-3 rounded relative <?= (isset($error) ? '' : 'hidden' ) ?> " role="alert">
        <strong class="font-semibold">Email not registered!</strong>
        
      </div>          
  </div>
</div>
</form>

<?php include "./layouts/bottom.php"; ?>

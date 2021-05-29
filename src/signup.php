<?php include "./layouts/top.php"; ?>

<?php
include '../db/db.php';

if (isset($_SESSION['email'])) {
  header("location:dashboard.php");
}


if (isset($_POST['signup'])) {
  $full_name = $_POST['fullname'];
  $email = $_POST['email'];
  $income = $_POST['income'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  //validate email
  $query = "SELECT * FROM `users` WHERE `email`= '$email'";
  $res = mysqli_query($conn, $query);

  if (mysqli_num_rows($res) > 0) {
    echo "Email already registered!";
  } else {

    if ($password !== $confirm_password) {
      echo "passwords not matched";
      return;
    }

    $query = "INSERT INTO `users`(`full_name`,`email`,`income`,`password`) VALUES('$full_name','$email',$income,'$password')";
    $res = mysqli_query($conn, $query);


    if ($res) {
      $_SESSION['email'] = $email;
      $_SESSION['userId'] = mysqli_insert_id($conn);
      header("location: dashboard.php");
    } else {
      echo mysqli_error($conn);
    }
  }
}

?>



<form action="#" method="post">
  <div class=" flex flex-col px-24 lg:px-64  py-24 justify-center items-center space-y-4">
    <div class="lg:w-2/6  bg-gray-100 rounded-lg p-8 flex flex-col  mt-10 md:mt-0">
      <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Signup</h2>

      <div class="relative mb-4">
        <label for="text" class="leading-7 text-sm text-gray-600">Full Name</label>
        <input type="text" id="fullname" name="fullname" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" autofocus required>
      </div>
      <div class="relative mb-4">
        <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
        <input type="email" id="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
      </div>
      <div class="relative mb-4">
        <label for="text" class="leading-7 text-sm text-gray-600">Income</label>
        <input type="text" id="income" name="income" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" autofocus required>
      </div>
      <div class="relative mb-4">
        <label for="password" class="leading-7 text-sm text-gray-600">Password</label>
        <input type="password" id="password" name="password" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
      </div>
      <div class="relative mb-4">
        <label for="password" class="leading-7 text-sm text-gray-600">Re-type Password</label>
        <input type="password" id="confirm_password" name="confirm_password" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
      </div>
      <button type="submit" name="signup" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">Signup</button>

      <a href="./login.php" class="text-sm text-indigo-500 mt-3 underline hover:text-indigo-400">Already have an account?</a>

    </div>
  </div>
</form>
<?php include "./layouts/bottom.php"; ?>
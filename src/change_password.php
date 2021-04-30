<?php include "./layouts/top.php"; ?>

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

    </div>
  </div>
</form>
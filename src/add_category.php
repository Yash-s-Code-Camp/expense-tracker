<?php
    include "./layouts/top.php";
?>

<?php

    if (isset($_POST['add_category'])) {
        $title = $_POST['category_title'];
        //$icon_file = $_FILES['icon'];

        if (isset($_FILES) ) {
          # code...
        }

        

    }


?>

<form action="#" method="post">
<div class=" flex flex-col px-24 lg:px-64  py-24 justify-center items-center space-y-4">
  <div class="lg:w-2/6  bg-gray-100 rounded-lg p-8 flex flex-col  mt-10 md:mt-0">
    <h2 class="text-gray-900 text-lg font-medium title-font mb-5">Add Category</h2>
    
      <div class="relative mb-4">
        <label for="category_title" class="leading-7 text-sm text-gray-600">Category Title</label>
        <input type="text" id="category_title" name="category_title" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" autofocus required>
      </div>
      <div class="relative mb-4">
        <label for="icon" class="leading-7 text-sm text-gray-600">Icon</label>
        <input type="file" id="icon" name="icon" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
      </div>
      <button type="submit" name="add_category" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">ADD</button>
    
  </div>
</div>
</form>

<?php
    include "./layouts/bottom.php";
?>
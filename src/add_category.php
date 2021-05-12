<?php
include "./layouts/top.php";
include "../db/db.php";
?>

<?php
$err = $msg = "";
if (isset($_POST['add_category'])) {
  
  $title = $_POST['category_title'];
  
  if ($_FILES['icon']['name'] != "") {
    $file = uploadImg($_FILES['icon']);
  } else {
    $err = "File Not Selected";
  }

  $sql = "INSERT INTO `categories` (`name`,`icon`) VALUES ('$title','$file')";
  if (mysqli_query($conn,$sql)) {
    $msg = "Category Added.";
  }else{
    $err = "Error while adding Category.";
  }

}


?>

<form action="#" method="post" enctype="multipart/form-data">
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
      <input type="submit" name="add_category" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg" value="ADD" />
      
      <div id="alert" class=" mt-4  px-4 py-3 rounded relative  bg-red-100  border-red-400 text-red-700 <?= ($err != ""  ? '' : 'hidden' ) ?>"   role="alert">
        <strong class="font-semibold"><?= $err ?></strong>
        
      </div>
      <div id="alert" class=" mt-4  px-4 py-3 rounded relative bg-green-100  border-green-400 text-green-700 <?= ($msg != ""  ? '' : 'hidden' ) ?>"   role="alert">
        <strong class="font-semibold"><?= $msg ?></strong>
        
      </div>
    </div>
  </div>
</form>

<?php
include "./layouts/bottom.php";

function uploadImg($file)
{
  $filename = $file['name'];
  $file_tmp = $file['tmp_name'];
  $file_type = $file['type'];

  $file_type = explode("/", $file_type);
  $file_type = strtolower($file_type[0]);

  $file_ext =  explode(".", $filename);
  $file_ext = strtolower(end($file_ext));

  $file_new_name = uniqid("", true) . "." . $file_ext;

  $file_destination = "../upload/";

  if ($file_type != "image") {
    echo "<script>alert('Only Image file allowed.')</script>";
    return;
  } else {
    if (!move_uploaded_file($file_tmp, $file_destination . $file_new_name)) {
      echo "<script>alert('Error while uploading file')</script>";
    }
  }

  return $file_new_name;
}
?>
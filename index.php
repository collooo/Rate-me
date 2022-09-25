<?php
session_start();
if(isset($_SESSION["status"])){

include('server.php');
include('function.php');
    $user_data = check_login($con);
    if (isset($_POST['upload'])) {
      $mobno = $user_data['mobno'];
      $filename = $_FILES["uploadfile"]["name"];
      $tempname = $_FILES["uploadfile"]["tmp_name"];
      $folder = "./image/" . $filename;
   
      $db = mysqli_connect("localhost", "root", "", "smartchoice");
   
      // Get all the submitted data from the form
      $sql = "UPDATE registration SET filename= '$filename' WHERE mobno = $mobno";
      // UPDATE MyGuests SET lastname='Doe' WHERE id=2
   
      // Execute query
      mysqli_query($db, $sql);
   
      // Now let's move the uploaded image into the folder: image
      if (move_uploaded_file($tempname, $folder)) {
          echo "<h3>  Image uploaded successfully!</h3>";
      } else {
          echo "<h3>  Failed to upload image!</h3>";
      }
  }

?>


<form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" type="file" name="uploadfile" value="" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="upload">Update Profile</button>
            </div>
        </form>



<?php
}
else{
  header("Location: login.php");
}
?>


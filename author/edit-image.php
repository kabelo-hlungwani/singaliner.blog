<!DOCTYPE html>
<html lang="en">
<?php
    include 'connect.php';
 
    // Check connection
    if (mysqli_connect_errno())
      {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
     
      if(!isset($_SESSION)) 
      { 
          session_start(); 
          $email=$_SESSION['email'];
          $idadmin=$_SESSION['admin_id'];
      
      }

    ?> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Images-Singaliner Inc</title><link rel="icon" href="assets/img/logo.png">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Barlow">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="https://cdn.quilljs.com/1.0.0/quill.snow.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/login-form-1.css">
    <link rel="stylesheet" href="assets/css/login-form.css">
    <link rel="stylesheet" href="assets/css/Pretty-Login-Form.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<?php

include 'connect.php';

if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}



$id=$_GET['edt'];





if(isset($_POST['add']))
{

// Posted Values
$cat=$_POST['category'];
$imgfile=$_FILES["image"]["name"];
// get the image extension
$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo '<script>alert("Invalid format. Only jpg / jpeg/ png /gif format allowed")window.location = "add-images.php";</script>';
}
else
{
//rename the image file
$imgnewfile=md5($imgfile).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["image"]["tmp_name"],"gallery/".$imgnewfile);
// Query for insertion data into database
$query=mysqli_query($conn,"UPDATE gallery SET section='$cat', picture='$imgnewfile' where img_id='$id'");
if($query)
{

echo '<script>alert("Image uploaded.");window.location = "gallery.php";</script>';
}
else
{
    echo '<script>alert("Something went wrong.");window.location = "add-images.php";</script>';
}}
    




}


?>
<body>
    <div class="container shadow-lg" data-aos="fade-down-right" data-aos-duration="900" data-aos-delay="500" style="font-family: Barlow, sans-serif;padding-bottom: 46px;">
        <form method="post"  enctype="multipart/form-data" style="margin-top: 50px;">
            <h2 class="text-right"><a href="gallery.php"><i class="fa fa-remove" style="color: rgb(61,62,64);font-size: 23px;"></i></a></h2>
            <h2 class="text-center">Update Image In Gallery</h2><label>Upload Image(s)</label>
            <div class="form-group"><input class="form-control-file" type="file" name="image" required=""></div><label>Gallery Category</label>
            <div class="form-group"><select class="form-control" name="category" required="">
                    <optgroup label="This is a group">
                        <option value="" selected="">Category</option>
                        <?PHP          
         
         $result=mysqli_query($conn,"SELECT * from gallery_category");
         $rows=mysqli_num_rows($result);        
         
         if ($rows>0) {
           
         
        while ($rows=mysqli_fetch_array($result)) {
            
            ?>
                        <option value="<?php echo $rows['category']?>"><?php echo $rows['category']?></option>

                        <?php }
         }
                        ?>
                   
                    </optgroup>
                </select></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="add" style="background: var(--gray-dark);border-color: transparent;">Post</button></div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
    <script src="assets/js/Quill-Text-Editor.js"></script>
</body>

</html>
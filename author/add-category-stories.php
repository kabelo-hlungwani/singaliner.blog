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
    <title>category-Singaliner Inc</title><link rel="icon" href="assets/img/logo.png">
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

$heading=$_POST['heading'];
    
 $query=mysqli_query($conn,"SELECT * FROM blog_category where category='$heading'");
 $data=mysqli_fetch_array($query);


if($heading==$data['category'])
{

echo '<script>alert(" category Exist.");window.location = "s-category.php";</script>';

}else
{


$edit=mysqli_query($conn,"INSERT INTO blog_category(admin_id,category) VALUES('$id','$heading')");  


if($edit){
mysqli_close($conn);

echo '<script>alert(" category added.");window.location = "s-category.php";</script>';

exit;

}
}



}


?>
<body>
    <div class="container shadow-lg" data-aos="fade-down-right" data-aos-duration="900" data-aos-delay="500" style="font-family: Barlow, sans-serif;padding-bottom: 46px;">
        <form method="post" style="margin-top: 50px;">
            <h2 class="text-right"><a href="s-category.php"><i class="fa fa-remove" style="color: rgb(61,62,64);font-size: 23px;"></i></a></h2>
            <h2 class="text-center">Add blog to categories</h2><label>Category</label>
            <div class="form-group"><input class="form-control" type="text" name="heading" onkeydown="return /[a-z, ]/i.test(event.key)"
    onblur="if (this.value == '') {this.value = '';}"
    onfocus="if (this.value == '') {this.value = '';}"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" name="add" type="submit" style="background: var(--gray-dark);border-color: transparent;">Add</button></div>
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